<?php
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class KargoService{
    static public function siparisDurumunaGoreKargola($order){

        if($order['orderStatusId']==OrderStatus::ARASKARGOYAVERILDI){
            $result = self::firmayaGoreKargola('aras', $order);
        } else {
            $result = _ReturnError('12','234');
        }
        return $result;
    }
    static public function firmayaGoreKargola($firma, $order){
        $setting = self::getFirmaSetting($firma);
        if($setting){
            if($firma=='aras'){
                return ArasKargo::kayitAc($order);
            }
        }
    }
    static private function getFirmaSetting($firma){
        $settings = [
            'aras' =>[
                'apiname'=>'',
                'apipass'=>'',
                'apicode'=>'',
            ]
        ];
        if(isset($settings[$firma])){
            return $settings[$firma];
        }
        return _ReturnError('kargo hata', 'kargo hata açıklama');
    }
}
class ArasKargo{
    static function kayitAc($order){
        return _ReturnSucces('Aras KArgo', 'Açıldı');
    }
}
