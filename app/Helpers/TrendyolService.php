<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use \Firebase\JWT\JWT;
use Firebase\JWT\Key;

class TrendyolService{
    const WEBSERVICE_URL = 'https://api.trendyol.com/sapigw/';
    const supplierid = '108498';
    const username = 'OtttIGZPJFwCqonagh2v';
    const password = '8D5OhXAwAE1JxU1uJNIq';

    static function getCategories($categoryId=null){
        $response = \Http::get(self::WEBSERVICE_URL.'product-categories');
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
        $response = \Http::get(self::WEBSERVICE_URL.'product-categories/'.$categoryId.'/attributes');
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
