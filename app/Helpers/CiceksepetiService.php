<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use \Firebase\JWT\JWT;
use Firebase\JWT\Key;

class CiceksepetiService{
    const WEBSERVICE_URL = 'https://apis.ciceksepeti.com/api/v1/';
    static function getCategories($categoryId=null){
        $response =  Http::withHeaders([
            'x-api-key' => env('CICEKSEPETI_APIKEY'),
        ])->get(self::WEBSERVICE_URL.'Categories');
        $data = json_decode($response, true);
        if(empty($data)) return [];
        if(!isset($data['categories'])){
            return [];
        }
        if($categoryId ){
            $category = self::findSubCategory($data['categories'], $categoryId);
            if($category){
                $category['specs'] = self::getCategorySpecs($categoryId);
            }
            return $category;
        }

        return  $data['categories'];
    }
    static function getCategorySpecs($categoryId){
        $response = Http::withHeaders([
            'x-api-key' => env('CICEKSEPETI_APIKEY'),
        ])->get(self::WEBSERVICE_URL.'Categories/'.$categoryId.'/attributes');
        $data = json_decode($response, true);

        if(empty($data)) return [];
        if(isset($data['categoryAttributes'])){
            return $data['categoryAttributes'];
        }
        return [];
    }

    private static function findSubCategory($categories, $categoryId){
        $findcategory = [];
        foreach($categories as $category){
            if($category['id']==$categoryId){
                return $category;
            } else {
                if($category['subCategories']){
                    $findcategory =  self::findSubCategory($category['subCategories'], $categoryId);
                   if($findcategory){
                       return $findcategory;
                   }
                }
            }
        }
        return $findcategory;
    }
}
