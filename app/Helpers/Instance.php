<?php
class Instance{
    public static function Slide()
    {
        $order['slideId']='new';
        $order['code']='';
        $order['name']='';
        $order['status']='';
        return $order;
    }
    public static function Order()
    {
        $order = self::loadJson('order');
        $order['orderId']='new';
        $order['marketplaceId']='4';
        $order['createdAt']=date('Y-m-d H:i:s');
        return $order;
    }
    public static function User()
    {
        $order = self::loadJson('user');
        $order['userId']='new';
        $order['createdAt']=date('Y-m-d H:i:s');
        return $order;
    }

    public static function loadJson($endpoint){
        $json_path = dirname(__FILE__).'/instances/'.$endpoint.'.json';
        if(is_file($json_path)){
            $json = file_get_contents($json_path);
            return json_decode($json, 1);
        } else {
            return [];
        }
    }
}
