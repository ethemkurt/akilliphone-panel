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
    public static function orders($page=1, $offset=50){
        $page = max(1, (int)$page);
        $response = self::GET('orders', ['page'=>$page, 'offset'=>$offset]);
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
    public static function order_status($page){
        $response = self::GET('orders/order-status', []);
        if($response['data'] ){
            return $response['data'];
        }
        return [];
    }
    public static function order_state($orderStatusId){
        $response = self::GET('orders/order-status/'.$orderStatusId, []);
        if($response['data'] ){
            return $response['data'];
        }
        return [];
    }
/* customer */
    public static function customers($page=1, $offset=50){
        $page = max(1, (int)$page);
        $offset = max(10, (int)$offset);
        $response = self::GET('users', ['page'=>$page, 'offset'=>$offset]);
        if($response['data'] ){

            return $response['data'];

        }
        return [];
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
        //die(json_encode($data, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
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

        if($response->status()=='500'){
            die('Webservis İşlem Hatası: '.$response->body());
        }
        if($response->status()=='502'){
            die('Webservis Getaway Hatası: '.$response->body());
        }
        $responseData = json_decode($response->body(), true);
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
