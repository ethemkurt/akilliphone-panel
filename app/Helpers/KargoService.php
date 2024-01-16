<?php
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class KargoService{
    static public function siparisDurumunaGoreKargola($order){

        if($order['orderStatusId']==OrderStatus::ARASKARGOYAVERILDI){
            $result = self::firmayaGoreKargola('aras', $order);
        } else {
            $result = [];
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
    static public function getFirmaSetting($firma){
        $settings = [
            'aras' =>[
                'apiname'=>'akilliphone',
                'apipass'=>'sibel1234',
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
        //die(json_encode($order, JSON_PRETTY_PRINT));
        //dd($order);
        $setting = KargoService::getFirmaSetting('aras');
        ini_set("soap.wsdl_cache_enabled", false);
        $client = new SoapClient("https://customerws.araskargo.com.tr/arascargoservice.asmx?WSDL");
        $city = $order['shippingAddress']['city'];
        $state = $order['shippingAddress']['district'];
        $address = $order['shippingAddress']['addressLine1'] .' '.$order['shippingAddress']['district'] .'/'.$order['shippingAddress']['city'];
        $order["invoiceNumber"] = "YOK";
        $orderNumber = 1000000000000 + (int)$order["orderId"];
        $params= array(
            "UserName"              => $setting['apiname'],//"akilliphone",
            "Password"              => $setting['apipass'],//"sibel1234",
            "TradingWaybillNumber"  => $orderNumber,
            "InvoiceNumber"  		=> $orderNumber,
            "ReceiverName"			=> html_entity_decode($order['shippingAddress']['firstname'] .' '.$order['shippingAddress']['lastname'], ENT_COMPAT, "UTF-8"),
            "ReceiverAddress"       => html_entity_decode($address, ENT_COMPAT, "UTF-8"),
            "ReceiverPhone1"        => $order['shippingAddress']['phone'],
            "ReceiverCityName"      => $city,
            "ReceiverTownName"      => $state,
            "IntegrationCode"      	=> $orderNumber,
            "PayorTypeCode"      	=> "1",
            "IsCod"            		=> 0, //'Tahsilatlı Kargo gönderisi (0=Hayır, 1=Evet)
            "IsWorldWide"      		=> 0,// Yurtdışı gönderisi mi (0=Yurtiçi, 1=Yurtdışı)
            "PieceCount"      		=> 1,
            "PieceDetails"			=> [[
                "VolumetricWeight"=>"1",
                "Weight"=>"1",
                "BarcodeNumber"=>$orderNumber,
                "ProductNumber"=>1,
                "Description"=>'Online Satış'
            ]],
        );

        $send['orderInfo']['Order'] = array($params);
        $send['userName'] = $setting['apiname'];
        $send['password'] = $setting['apipass'];
        $response = $client->SetOrder($send);
        $result = json_decode(json_encode($response, JSON_UNESCAPED_UNICODE), 1);
        if(!isset($result['SetOrderResult'])){
            return _ReturnError('Başarısız', 'Araskargo hata', ['Aras Kargo: Webservis iletişimi hatalı']);
        }
        if(!isset($result['SetOrderResult']['OrderResultInfo'])){
            return _ReturnError('Başarısız','Araskargo hata', ['Aras Kargo: Webservis sonucu hatalı']);
        }
        if(!isset($result['SetOrderResult']['OrderResultInfo']['ResultCode'])){
            return _ReturnError('Başarısız','Araskargo hata', ['Aras Kargo: Webservis sonucu hatalı']);
        }
        if($result['SetOrderResult']['OrderResultInfo']['ResultCode']!='0'){
            return _ReturnError('Başarısız','Araskargo hata', ['Aras Kargo: '.$result['SetOrderResult']['OrderResultInfo']['ResultMessage']]);
        }
        if(isset($result['SetOrderResult']['OrderResultInfo']['InvoiceKey'])){
            return _ReturnSucces($result['SetOrderResult']['OrderResultInfo']['InvoiceKey'], 'Araskargo Kaydı Açıldı');
        }
        return _ReturnError('Başarısız','Araskargo hata', ['Aras Kargo: Bilinmeyen Hata']);
    }

}
