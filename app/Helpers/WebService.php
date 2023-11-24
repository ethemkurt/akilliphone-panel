<?php
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use \Firebase\JWT\JWT;
use Firebase\JWT\Key;
class WebService{
    const WEBSERVICE_URL = 'http://api.duzzona.site/';
    const AUTH_URL = 'http://212.22.69.229:44302/api/Authenticate';
    protected $userName = '';
    protected $userPassword = '';
    public static function checkUser($username, $password)
    {
        $result = [
            'token'=>false,
            'tokenData'=>false,
            'user'=>[],
            'error'=>false,
        ];
        try{
            $token = self::TOKEN($username, $password);
            if($token){
                $tokenData = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
                if($tokenData){
                    $tokenData = (array)$tokenData;
                    if(isset($tokenData['http://schemas.xmlsoap.org/ws/2005/05/identity/claims/nameidentifier'])){
                        $userId = $tokenData['http://schemas.xmlsoap.org/ws/2005/05/identity/claims/nameidentifier'];
                        $user = self::getUser($userId, $token);
                        if($user){
                            $user['jwtToken'] = $token;
                            $user['jwtExp'] = $tokenData['exp'];
                            $user['fullName'] = $user['firstName'].' '.$user['lastName'];
                            $result['tokenData'] = $tokenData;
                            $result['user'] = $user;
                            $result['token'] = $token;
                        } else {
                            $result['error'] = 'Kullanıcı Bilgisi alınamadı';
                        }
                    } else {
                        $result['error'] = 'Kullanıcı Idsi alınamadı';
                    }
                } else {
                    $result['error'] = 'Kullanıcı Tokenı hatalı';
                }
            }  else {
                $result['error'] = 'Kullanıcı Tokenı alınamadı';
            }
        } catch (\Exception $ex){
            $result['error'] = $ex->getMessage();
        }
        return $result;
    }
    public  static function getUser($userId, $token){
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get(self::AUTH_URL.'/user', ['userId'=>$userId]);
        return $response['data'];
    }
    public static function isLogged(){
        $user = request()->session()->get('user', null);
        if($user){
            if($user['jwtExp']<time()){
                $user = null;
            }
            return $user;
        }
        return $user;
    }
    public static function logout()
    {
        request()->session()->put('jwtToken', null);
        request()->session()->put('user', null);
    }
    public static function login($user, $tokenData)
    {
        request()->session()->put('jwtToken', $user['jwtToken']);
        request()->session()->put('user', $user);
    }
/* products */
    public static function get_endpoint($endpoint, $data=[]){
        $response = self::GET($endpoint, $data);
        if($response['data'] ){
            return $response['data'];
        }
        return [];
    }
    public static function products($filter){
        $filter['page'] = max(1, (int)(isset($filter['page'])?$filter['page']:1));
        $filter['offset'] = max(25, (int)(isset($filter['offset'])?$filter['offset']:25));
        $filter['text'] = (isset($filter['text'])?$filter['text']:'');
        $response = self::GET('products', $filter);
        if($response['data'] ){
            return $response['data'];
        }
        return [];
    }
    public static function product($productId){
        $response = self::GET('orders/'.$productId, []);
        if($response['data'] ){
            return $response['data'];
        }
        return [];
    }
    public static function variant($variantId){
        $response = self::GET('variants/'.$variantId, []);
        if($response['data'] ){
            return $response['data'];

        }
        return [];
    }
/* orders */
    public static function orders($page=1, $offset=50, $params){
        $page = max(1, (int)$page);
        $params['page'] = $page;
        $params['offset'] =$offset;

        $response = self::GET('orders', $params);
        if($response['data'] ){
            return $response['data'];
        }
        return [];
    }
    public static function order($orderId){
        $response = self::GET('orders/'.$orderId, []);
        if($response['data'] ){
            return $response['data'];
        }
        return [];
    }
    public static function newOrder($body){
        self::fixOrderRequest($body);
        $response = self::POST('orders',$body);
        return $response;
    }
    public static function editOrder($orderId, $body){
        self::fixOrderRequest($body);
        $response = self::PUT('orders/'.$orderId, $body);
        return $response;
    }
    public static function orderDelete($orderId){
        $response = self::DELETE('orders/'.$orderId, []);
        return $response;
    }
    /*orderStatuses*/
    public static function orderStatuses($page){
        $response = self::GET('orders/order-status', []);
        if($response['data'] ){
            return $response['data'];
        }
        return [];
    }
    public static function orderStatus($orderStatusId){
        $response = self::GET('orders/order-status/'.$orderStatusId, []);
        if($response['data'] ){
            return $response['data'];
        }
        return [];
    }
    public static function orderStatusNew($orderStatus){
        $response = self::POST('orders/order-status', $orderStatus);
        if($response){
            return $response;
        }
        return [];
    }
    public static function orderStatusEdit($orderStatusId, $orderStatus){
        $response = self::PUT('orders/order-status/'.$orderStatusId, $orderStatus);
        if($response ){
            return $response;
        }
        return [];
    }
    public static function orderStatusDelete($orderStatusId){
        $response = self::DELETE('orders/order-status/'.$orderStatusId, []);
        if($response ){
            return $response;
        }
        return [];
    }
    /*paymentStatuses*/
    public static function paymentStatuses($page){
        $response = self::GET('orders/payment-status', []);
        if($response['data'] ){
            return $response['data'];
        }
        return [];
    }
    public static function paymentStatus($orderStatusId){
        $response = self::GET('orders/payment-status/'.$orderStatusId, []);
        if($response['data'] ){
            return $response['data'];
        }
        return [];
    }
    public static function paymentStatusNew($orderStatus){
        $response = self::POST('orders/payment-status', $orderStatus);
        if($response){
            return $response;
        }
        return [];
    }
    public static function paymentStatusEdit($orderStatusId, $paymentStatus){
        $paymentStatus['id'] = $paymentStatus['paymentStatusId'];
        unset($paymentStatus['paymentStatusId']);
        $response = self::PUT('orders/payment-status/'.$orderStatusId, $paymentStatus);
        if($response ){
            return $response;
        }
        return [];
    }
    public static function paymentStatusDelete($orderStatusId){
        $response = self::DELETE('orders/payment-status/'.$orderStatusId, []);
        if($response ){
            return $response;
        }
        return [];
    }
    /*paymentType*/
    public static function paymentTypes($page){
        $response = self::GET('orders/payment-type', []);
        if($response['data'] ){
            return $response['data'];
        }
        return [];
    }
    public static function paymentType($orderStatusId){
        $response = self::GET('orders/payment-type/'.$orderStatusId, []);
        if($response['data'] ){
            return $response['data'];
        }
        return [];
    }
    public static function paymentTypeNew($orderStatus){
        $response = self::POST('orders/payment-type', $orderStatus);
        if($response){
            return $response;
        }
        return [];
    }
    public static function paymentTypeEdit($paymentTypeId, $paymentType){
        $paymentType['id'] = $paymentType['paymentTypeId'];
        unset($paymentType['paymentTypeId']);
        $response = self::PUT('orders/payment-type/'.$paymentTypeId, $paymentType);
        //dd(json_encode($paymentType, JSON_PRETTY_PRINT), $response);
        if($response ){
            return $response;
        }
        return [];
    }
    public static function paymentTypeDelete($paymentTypeId){
        $response = self::DELETE('orders/payment-type/'.$paymentTypeId, []);
        if($response ){
            return $response;
        }
        return [];
    }
    /*user*/
/* customer */
    public static function users($page=1, $offset=50, $filter){
        $params['page'] = max(1, (int)$page);
        $params['offset'] = max(10, (int)$offset);
        if(isset($filter['text'])){
            $params['text'] = $filter['text'];
        }

        $response = self::GET('users', $params);

        if($response['data'] ){

            return $response['data'];

        }
        return [];
    }
    public static function user($userId){
        $response = self::getUser($userId, request()->session()->get('jwtToken', null));
        if($response['data'] ){
            return $response['data'];
        }
        return [];
    }
    public static function userNew($user){
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' .  request()->session()->get('jwtToken', null),
        ])->post(self::AUTH_URL.'/register-admin', json_encode($user, JSON_UNESCAPED_UNICODE));
        return self::standartResponse($response) ;
    }

    public static function orderHistoryNew($orderHistory){
        $response = self::post('orders/history', $orderHistory);
        dd($response);
        return self::standartResponse($response) ;
    }
    public static function brand($brandId=0){
        $response = self::static('brands/list', []);
        if(isset($response['data'])){
            foreach($response['data']['items'] as $brand){
                if($brand['brandId']==$brandId){
                    return $brand;
                }
            }
        }
        return [];
    }
    public static function countries(){
        $response = self::static('address/countries', []);
    }
    public static function cities($countryId=0){
        return self::static('address/cities', []);
    }
    public static function district($cityId){
        return self::static('address/district/'.$cityId, []);
    }
    static private function TOKEN($username, $password){
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . request()->session()->get('token', null),
        ])->post(self::AUTH_URL.'/login', ['username'=>$username, 'password'=>$password]);
        $responseData = json_decode($response->body(), true);
        if(isset($responseData['token'])){
            return $responseData['token'];
        }
        return null;
    }
    static private function GET($service, $data){
        try{
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . request()->session()->get('jwtToken', null),
            ])->get(self::WEBSERVICE_URL.$service, $data);

            return self::standartResponse($response);

        } catch (\Exception $ex){
            return self::standartErrorResponse($ex->getMessage());
        }
    }
    static private function POST($service, $data){
        //die(json_encode($data, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . request()->session()->get('jwtToken', null),
        ])->post(self::WEBSERVICE_URL.$service, $data);
        return self::standartResponse($response);
    }
    static private function PUT($service, $data){
        //dd(self::WEBSERVICE_URL.$service, $response, json_encode($data, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . request()->session()->get('jwtToken', null),
        ])->put(self::WEBSERVICE_URL.$service, $data);
        return self::standartResponse($response);
    }
    static private function DELETE($service, $data){
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . request()->session()->get('jwtToken', null),
        ])->delete(self::WEBSERVICE_URL.$service, $data);
        return self::standartResponse($response);
    }
    private static function static($endpoint){
        $json_path = public_path().'/jsons/'.$endpoint.'.json';
        if(is_file($json_path)){
            $json = file_get_contents($json_path);
            return json_decode($json, 1);
        } else {
            return [];
        }
    }

    static private function standartErrorResponse($error){
        $result['status'] = 0;
        $result['data'] =  [];
        $result['errors'] = [$error];
        return $result;
    }
    static private function standartResponse($response){

        $responseData = json_decode($response->body(), true);

        $errors = [];
        if($response->status()=='500'){
            $errors[]= 'Webservis Hatası';
        }
        if(empty($responseData)){
            $responseData['errors'][]= ['message'=>'Webservis İşlem Hatası: '.$response->body()];
        }

        if($response->status()=='502'){
            $responseData['errors'][]= ['message'=>'Webservis Getaway Hatası: '.$response->body()];
        }
        if(isset($responseData['errors']) && $responseData['errors']){
            foreach($responseData['errors'] as $error){

                if(is_string($error)){
                    $errors[] = $error;
                } elseif(is_array($error)){
                    if(isset($error['message'])){
                        $errors[] = $error['message'];
                    } else{
                        $errors[] = json_encode(current($error), JSON_UNESCAPED_UNICODE);
                    }
                }
            }
            return [
                'status'=>0,
                'data'=>[],
                'errors' => $errors
            ];
        }

        // $responseData = json_decode($response->body(), true);
        if($response->status()==200){
            if($responseData ){
                $result['status'] = 1;
                $result['data'] =  isset($responseData['data'])?$responseData['data']:[];
            } else {
                $result['status'] = 0;
                $result['data'] =  [];
                //$result['errors'] = ['Sunucu yanıtı geçersiz'];
            }
        } else {
            $result['status'] = 0;
            $result['data'] =  [];
            //$result['errors'] = ['Istek onaylanmadı. Http Kodu: '.$response->status()];
        }

        $result['errors'] = isset($responseData['errors'])?$responseData['errors']:[];

        return $result;
    }
    static function fixOrderRequest(&$order){
        $order['shippingTrackingNumber'] = (string)$order['shippingTrackingNumber'] ;
        $order['shippingTrackingUrl'] = (string)$order['shippingTrackingUrl'] ;
        return $order;
    }
}
