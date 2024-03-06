<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use \Firebase\JWT\JWT;
use Firebase\JWT\Key;

class N11Service{
    const WEBSERVICE_URL = 'https://api.n11.com/ws/';

    static function getCategories($categoryId=null){
        if($categoryId){
            $category = self::getSubCategories($categoryId);

            if($category){
                return $category;
            } else{
                $attributes = self::getCategoryAttributes($categoryId);
                if($attributes){
                    return $attributes;
                }
            }
        } else {
            return self::getTopLevelCategories();
        }
    }
    static function getCategoryAttributes($categoryId){
        if(!$categoryId) return array();

        $client = self::get_client('CategoryService');
        if($client['client']){
            $params =  self::get_params( );
            $params['categoryId'] = $categoryId;
            $params['pagingData'] = array('currentPage'=>1, 'pageSize'=>'500' );
            $retval = $client['client']->GetCategoryAttributes($params);

            if($retval->result->status=='success')
            {
                return json_decode(json_encode($retval->category, JSON_UNESCAPED_UNICODE), 1);
            }
        }
        return array();
    }
    static function getCategorySpecs($categoryId){
        if($categoryId){

        } else {
            return self::getTopLevelCategories();
        }
    }

    static public function getTopLevelCategories(){
        $client = self::get_client('CategoryService');
        if($client['client']){
            $params =  self::get_params();
            $retval = $client['client']->GetTopLevelCategories($params);
            if($retval->result->status=='success')
            {
                return json_decode(json_encode($retval->categoryList->category, JSON_UNESCAPED_UNICODE), 1);
            }
        }
        return array();
    }
    static public function get_client( $service='ProductService' ){
        $response = [
            'client'=>null,
            'message'=>''
        ];
        try{
            $response['client'] = new SoapClient("https://api.n11.com/ws/$service.wsdl", array('cache_wsdl' => WSDL_CACHE_NONE));
        } catch (\SoapFault $se) {
            $response['message'] = $se->getMessage();
        }  catch (\Exception $ex){
            $response['message'] = $ex->getMessage();
        }
        return $response;
    }

    static public function getSubCategories($categoryId=false){
        if(!$categoryId) return array();
        $client = self::get_client('CategoryService');
        if($client['client']){
            $params =  self::get_params();
            $params['categoryId'] = $categoryId;
            $params['lastModifiedDate'] = '01/01/2000 00:00';
            $retval = $client['client']->GetSubCategories($params);
            if($retval->result->status=='success' && property_exists($retval->category, 'subCategoryList'))
            {
                return json_decode(json_encode($retval->category->subCategoryList, JSON_UNESCAPED_UNICODE), 1);
            }
        }
        return array();
    }
    static private function get_params(){
        return  [
            "auth" => [
                "appKey" => env('N11_APIKEY'),
                "appSecret" => env('N11_APISECRET'),
            ],
        ];
    }
}
