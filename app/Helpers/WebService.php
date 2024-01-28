<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use \Firebase\JWT\JWT;
use Firebase\JWT\Key;
class WebService{
    const WEBSERVICE_URL = 'https://api.duzzona.site/';
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
                    if($tokenData['Active']!="1"){
                        $result['error'] = 'Kullanıcı Aktif Değil';
                        return $result;
                    }
                    if(isset($tokenData['http://schemas.xmlsoap.org/ws/2005/05/identity/claims/nameidentifier'])){
                        $role = $tokenData['http://schemas.microsoft.com/ws/2008/06/identity/claims/role'];
                        if($role=='SuperAdmin' || $role=='Admin' || $role=='Temsilci'){
                            $userId = $tokenData['http://schemas.xmlsoap.org/ws/2005/05/identity/claims/nameidentifier'];
                            $user = self::getUser($userId, $token);
                            if($user && isset($user['data'])){
                                $user = $user['data'];
                                $user['jwtToken'] = $token;
                                $user['jwtExp'] = $tokenData['exp'];
                                $user['ROLE'] = $role;
                                $user['fullName'] = $user['firstName'].' '.$user['lastName'];
                                $result['tokenData'] = $tokenData;
                                $result['user'] = $user;
                                $result['token'] = $token;
                            } else {
                                $result['error'] = 'Kullanıcı Bilgisi alınamadı';
                            }
                        } else{
                            $result['error'] = 'Bu alan için yetkiniz bılınmamakatadır';
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
        return self::standartResponse($response, self::AUTH_URL.'/user') ;
    }
    public static function isLogged(){
        $user = request()->session()->get('user', null);
        if($user){
            if($user['jwtExp']<time()){
                $user = null;
            } else{
                defined('CURRENT_ROLE') or define('CURRENT_ROLE', self::convertUserRole($user['ROLE']));
            }
            return $user;
        }
        return $user;
    }
    public static function logout()
    {
        request()->session()->put('jwtToken', null);
        request()->session()->put('user', null);
        request()->session()->put('SADMINTOKEN', null);
    }
    public static function login($user, $tokenData)
    {
        request()->session()->put('jwtToken', $user['jwtToken']);
        request()->session()->put('user', $user);
        request()->session()->put('SADMINTOKEN', self::SADMINTOKEN());
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
    public static function orders($page=1, $offset=50, $params=[]){
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
        $response = self::DELETE('orders/'.$orderId, [], true);
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
    public static function brands($page){
        $response = self::GET('brands', []);
        if($response['data']){
            return $response['data']['items'];
        }
        return [];
    }
    public static function categories($page){
        $response = self::GET('categories', []);
        if($response['data']['items']){


            return $response['data']['items'];
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
    public static function users($page=1, $offset=50, $filter=[]){
        $params['page'] = max(1, (int)$page);
        $params['offset'] = max(10, (int)$offset);
        if(isset($filter['text'])){
            $params['text'] = $filter['text'];
        }
        if(isset($filter['role'])){
            if($filter['role']=='user.admin'){
                $params['role'] = UserRole::ADMIN;
            } elseif($filter['role']=='user.bayi'){
                $params['role'] = UserRole::BAYI;
            } elseif($filter['role']=='user.uye'){
                $params['role'] = UserRole::UYE;
            } elseif($filter['role']=='user.temsilci'){
                $params['role'] = UserRole::TEMSILCI;
            }
        }

        $response = self::GET('users', $params);
        if($response['data'] ){

            return $response['data'];

        }
        return [];
    }

    public static function user($userId){
        $response = self::getUser($userId, request()->session()->get('SADMINTOKEN', null));
        if($response['data'] ){
            return $response['data'];
        }
        return [];
    }
    public static function userNew($user, $role){
        if($role==\UserRole::ADMIN){
            $webservice_method = 'register-admin';
        }elseif($role==\UserRole::BAYI){
            $webservice_method = 'register-bayi';
        }elseif($role==\UserRole::UYE){
            $webservice_method = 'register-uye';
        }elseif($role==\UserRole::TEMSILCI){
            $webservice_method = 'register-temsilci';
        } else {
            return false;
        }

        $response = self::POST($webservice_method, $user, true);
        return $response ;
    }
    public static function userEdit($user){
        $response = self::PUT( 'user',  $user);
        return $response ;
    }
    public static function userDelete($userId){
        $response = self::DELETE('user/'.$userId, [], FORCEADMIN );
        return $response ;
    }

    /* Review */
    public static function reviews($page=1, $offset=50, $filter){
        $params['page'] = max(1, (int)$page);
        $params['offset'] = max(10, (int)$offset);
        if(isset($filter['text'])){
            $params['text'] = $filter['text'];
        }
        if(isset($filter['sort'])){
            $params['sort'] = $filter['sort'];
        }
        if(isset($filter['sortby'])){
            $params['sortby'] = $filter['sortby'];
        }
        if(isset($filter['filterby'])){
            $params['filterby'] = $filter['filterby'];
        }

        $response = self::GET('reviews', $params);
        if($response['data'] ){
            return $response['data'];
        }
        return [];
    }
    public static function review($reviewId){
        $response = self::GET('reviews/'.$reviewId, []);
        if($response['data'] ){
            return $response['data'];
        }
        return [];
    }
    public static function reviewEdit($reviewId, $review){
        $response = self::PUT( 'reviews/'.$reviewId,  $review);
        return $response ;
    }
    public static function reviewDelete($reviewId){
        $response = self::DELETE( 'reviews/'.$reviewId, []);
        return $response ;
    }

    /* Question */
    public static function questions($page=1, $offset=50, $filter){
        $params['page'] = max(1, (int)$page);
        $params['offset'] = max(10, (int)$offset);
        if(isset($filter['text'])){
            $params['text'] = $filter['text'];
        }
        if(isset($filter['sortby'])){
            $params['sortby'] = $filter['sortby'];
        }
        if(isset($filter['sort'])){
            $params['sort'] = $filter['sort'];
        }
        if(isset($filter['filterby'])){
            $params['filterby'] = $filter['filterby'];
        }
        $response = self::GET('questions', $params);
        if($response['data'] ){
            return $response['data'];
        }
        return [];
    }
    public static function question($questionId){
        $response = self::GET('questions/'.$questionId, []);
        if($response['data'] ){
            return $response['data'];
        }
        return [];
    }
    public static function questionEdit($questionId, $question){
        $question['whoAnswered'] = \Current::User('id');
        $response = self::PUT( 'questions/'.$questionId,  $question);
        return $response ;
    }
    public static function questionDelete($questionId){
        $response = self::DELETE( 'questions/'.$questionId, []);
        return $response ;
    }
    /* attributes  */
    public static function attributes($page=1, $offset=50, $filter){
        $params['page'] = max(1, (int)$page);
        $params['offset'] = max(10, (int)$offset);
        $response = self::GET('attributes', $params);
        if($response ){
            return $response;
        }
        return [];
    }
    public static function attribute($attributeId){
        $response = self::GET('attributes/'.$attributeId, []);
        if($response['data'] ){
            return $response['data'];
        }
        return [];
    }
    public static function attributeNew( $attribute){
        $response = self::POST( 'attributes',  $attribute);
        return $response ;
    }
    public static function attributeEdit($attributeId, $attribute){
        $response = self::PUT( 'attributes/'.$attributeId,  $attribute);
        return $response ;
    }
    public static function attributeDelete($attributeId){
        $response = self::DELETE( 'attributes/'.$attributeId, []);
        return $response ;
    }
    /* attributesValue  */
    public static function attributeValue($attributeValueId){
        $response = self::GET('attribute-values/'.$attributeValueId, []);
        if($response['data'] ){
            return $response['data'];
        }
        return [];
    }
    public static function attributeValueNew( $attributeValue){
        $response = self::POST( 'attribute-values',  $attributeValue, FORCEADMIN);
        return $response ;
    }
    public static function attributeValueEdit($attributeValueId, $attributeValue){
        $response = self::PUT( 'attribute-values/'.$attributeValueId,  $attributeValue);
        return $response ;
    }
    /* option  */
    public static function options($page=1, $offset=50, $filter){
        $params['page'] = max(1, (int)$page);
        $params['offset'] = max(10, (int)$offset);
        $response = self::GET('options', $params);
        if($response ){
            return $response;
        }
        return [];
    }
    public static function option($optionId){
        $response = self::GET('options/'.$optionId, []);
        if($response['data'] ){
            return $response['data'];
        }
        return [];
    }
    public static function optionEdit($optionId, $option){
        $response = self::PUT( 'options/'.$optionId,  $option);
        return $response ;
    }
    /* option  */
    public static function optionValue($optionValueId){
        $response = self::GET('option-values/'.$optionValueId, []);

        if($response['data'] ){
            return $response['data'];
        }
        return [];
    }

    public static function orderHistory($orderId){
        $response = self::get('orders/history/'.$orderId, []);
        if(isset($response['data'])){
            return  $response['data'];
        }
        return [] ;
    }
    public static function orderHistoryNew($orderHistory){
        $response = self::post('orders/history', $orderHistory);
        return $response ;
    }
    public static function orderHistoryDelete($orderId){
        $response = self::DELETE('orders/history/'.$orderId, []);
        return $response;
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
    public static function brand_delete($brandId){
        $response = self::DELETE('brands/'.$brandId, []);

        if($response ){
            return $response;
        }
        return [];
    }
    public static function brand_add($body){
        $response = self::POST('brands',$body);
        if($response ){
            return $response;
        }
        return [];
    }
    public static function brand_edit($brandId,$body){

        $response = self::PUT('brands/'.$brandId,$body);

        if($response ){
            return $response;
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
    /** Slide */
    public static function slides($filter){
        $params['page'] = max(1, (int)$filter['page']);
        $params['offset'] = max(10, (int)$filter['offset']);
        if(isset($filter['text'])){
            $params['text'] = $filter['text'];
        }
        //$response = self::GET('users', $params);
        $response['totalCount'] = \App\Models\Slide::count();
        $response['data']['items'] = \App\Models\Slide::offset($params['page']-1)->limit($params['offset'])->get();
        if($response['data'] ){
            return $response['data'];
        }
        return [];
    }
    public static function slide($slideId=0){
        $slide = \App\Models\Slide::find($slideId) ;
        if($slide){
            $response = $slide->toArray() ;
            $rows = DB::table('slide_images')->where(['slideId'=>$response['id']])->get();
            if(!$rows->isEmpty()){
                foreach($rows as $row){
                    $response['images'][] =  $row;
                }
            }
        } else {
            $response = [];
        }
        return $response;
    }

    static private function SADMINTOKEN(){
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . request()->session()->get('token', null),
        ])->post(self::AUTH_URL.'/login', ['username'=>env('SUPERADMIN'), 'password'=>env('SUPERPASS')]);
        $responseData = json_decode($response->body(), true);
        if(isset($responseData['token'])){
            return $responseData['token'];
        }
        return null;
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
                'Authorization' => 'Bearer ' . request()->session()->get('SADMINTOKEN', null),
            ])->get(self::WEBSERVICE_URL.$service, $data);
            return self::standartResponse($response, self::WEBSERVICE_URL.$service);
        } catch (\Exception $ex){
            return self::standartErrorResponse($ex->getMessage());
        }
    }
    static private function POST($service, $data, $forceAdmin=false){
        if($forceAdmin){
            $Authorization = 'Bearer ' . request()->session()->get('SADMINTOKEN', null);
        } else {
            $Authorization ='Bearer ' . request()->session()->get('jwtToken', null);
        }
        $response = Http::withHeaders([
            'Authorization' => $Authorization,
        ])->post(self::WEBSERVICE_URL.$service, $data);
        //dd(self::WEBSERVICE_URL.$service, $response, json_encode($data, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE), self::standartResponse($response, self::WEBSERVICE_URL.$service));

        return self::standartResponse($response, self::WEBSERVICE_URL.$service);
    }
    static private function PUT($service, $data){
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . request()->session()->get('jwtToken', null),
        ])->put(self::WEBSERVICE_URL.$service, $data);
        //dd(self::WEBSERVICE_URL.$service, $response, json_encode($data, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE), self::standartResponse($response, self::WEBSERVICE_URL.$service));

        return self::standartResponse($response, self::WEBSERVICE_URL.$service);
    }
    static private function DELETE($service, $data, $forceAdmin=false){
        if($forceAdmin){
            $Authorization = 'Bearer ' . request()->session()->get('SADMINTOKEN', null);
        } else {
            $Authorization ='Bearer ' . request()->session()->get('jwtToken', null);
        }
        $response = Http::withHeaders([
            'Authorization' => $Authorization,
        ])->delete(self::WEBSERVICE_URL.$service, $data);
        return self::standartResponse($response, self::WEBSERVICE_URL.$service);
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
    static private function standartResponse($response, $endpoit=''){
        $errors = [];
        $responseData = json_decode($response->body(), true);
        if($response->status()=='400' || $response->status()=='500'){
            $errors[]= 'Webservis Hatası';
            if(isset($responseData['message'])){
                $errors[]=$responseData['message'];
            } else {
                $errors[]= $response->body();
            }
        }

        if(empty($responseData)){
            $responseData['errors'][]= ['message'=>'Webservis İşlem Hatası. Http Kodu: '.$response->status() .' Bilgi: '.$response->body()];
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
                        if(isset($error['title'])){
                            $errors[] = $error['title'];
                        }
                    } else{
                        $errors[] = json_encode(current($error), JSON_UNESCAPED_UNICODE);
                    }
                }
            }
            return [
                'status'=>0,
                'endpoit'=>$endpoit,
                'data'=>[],
                'errors' => $errors
            ];
        }

        // $responseData = json_decode($response->body(), true);
        $result['endpoit'] = $endpoit;
        if($response->status()==200 || $response->status()==201){
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

        $result['errors'] = isset($responseData['errors'])?$responseData['errors']:$errors;

        return $result;
    }
    static function fixOrderRequest(&$order){
        $order['shippingTrackingNumber'] = (string)$order['shippingTrackingNumber'] ;
        $order['shippingTrackingUrl'] = (string)$order['shippingTrackingUrl'] ;
        return $order;
    }
    static function convertUserRole($webServiceRole){
        if($webServiceRole=='Admin' || $webServiceRole=='SuperAdmin'){
            return UserRole::ADMIN;
        }elseif($webServiceRole=='Temsilci'){
            return UserRole::TEMSILCI;
        }elseif($webServiceRole=='Bayi'){
            return UserRole::BAYI;
        }elseif($webServiceRole=='Uye'){
            return UserRole::UYE;
        }
    }
}
