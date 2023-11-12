<?php
class OrderStatus extends \Enum{
    const ODEMEBEKLENIYOR = 26;
    const BEKLIYOR = 27;
    const ONAYLANDI = 28;
    const SIPARISHAZIRLANIYOR = 29;
    const ARASKARGOYAVERILDI = 30;
    const MNGKARGOYAVERILDI = 31;
    const SURATKARGOYAVERILDI = 32;
    const UPSKARGOYAVERILDI = 33;
    const YURTICIKARGOYAVERILDI = 34;
    const YANGOYAVERILDI = 35;
    const TESLIMEDILDI = 36;
    const IPTALEDILDI = 37;
    const IADEEDILDI = 38;
    const TEMINEDILIYOR = 39;
    const ULASILAMIYOR = 40;
    const INCELENIYOR = 41;
    const BASARISIZ = 42;
    const EKSIKSIPARIS = 43;
    const TELEFON = 44;
    const IADEDEGISIM = 45;
    const MAGAZAHAZIRLAYACAK = 46;
    const AVCILARHAZIRLAYACAK = 47;

    static function colors($class=null){
        return [];
    }
    static function color($const){
        $items = self::colors();
        if(isset($items[$const])){
            return $items[$const];
        }
        return 'success';
    }
    static function __($const){
        $items = [
            self::ODEMEBEKLENIYOR=>'Ödeme Bekleniyor',
            self::BEKLIYOR=>'Bekliyor',
            self::ONAYLANDI=>'Onaylandı',
            self::SIPARISHAZIRLANIYOR=>'Sipariş Hazırlanıyor',
            self::ARASKARGOYAVERILDI=>'ARAS Kargoya Verildi',
            self::MNGKARGOYAVERILDI=>'MNG Kargoya Verildi',
            self::SURATKARGOYAVERILDI=>'SÜRAT Kargoya Verildi',
            self::UPSKARGOYAVERILDI=>'UPS Kargoya Verildi',
            self::YURTICIKARGOYAVERILDI=>'YURTİÇİ Kargoya Verildi',
            self::YANGOYAVERILDI=>'Yango \'ya Verildi',
            self::TESLIMEDILDI=>'Teslim Edildi',
            self::IPTALEDILDI=>'İptal Edildi',
            self::IADEEDILDI=>'İade Edildi',
            self::TEMINEDILIYOR=>'Temin Ediliyor',
            self::ULASILAMIYOR=>'Ulaşılamıyor',
            self::INCELENIYOR=>'İnceleniyor',
            self::BASARISIZ=>'Başarısız',
            self::EKSIKSIPARIS=>'Eksik Sipariş',
            self::TELEFON=>'Telefon',
            self::IADEDEGISIM=>'İade / Değişim',
            self::MAGAZAHAZIRLAYACAK=>'Mağaza Hazırlayacak',
            self::AVCILARHAZIRLAYACAK=>'Avcılar Hazırlayacak',

        ];
        return isset($items[$const])?$items[$const]:$const;
    }
}
class PaymentType extends \Enum{
    /* idler kontrol edilidi*/
    const KREDIKARTI = 3;
    const HAVALE = 5;
    const KAPIDANAKIT = 6;
    const KAPIDAKREDIKARTI = 7;
    const MOBIL = 8;
    const PAYPAL = 9;
    const PARCALI = 10;
    const BAKIYE = 11;
    const ELDEN = 12;
    const HESAPTAN = 13;
    const N11 = 14;
    const GG = 15;
    const HB = 16;
    const AMAZON = 17;
    const HBBASEUS = 18;
    const N11BASEUS = 19;
    const TRENDYOL = 20;
    const GGBASEUS = 21;
    const GORDUMALDIMISBANKASI = 22;
    const CICEKSEPETI = 23;
    const MOTOKURYE = 24;



    static function colors($class=null){
        return [];
    }
    static function color($const){
        $items = self::colors();
        if(isset($items[$const])){
            return $items[$const];
        }
        return 'info';
    }
    static function __($const){
        $items = [
            self::KREDIKARTI=>__('enum.KREDIKARTI'),
            self::HAVALE=>__('enum.HAVALE'),
            self::KAPIDANAKIT=>__('enum.KAPIDANAKIT'),
            self::KAPIDAKREDIKARTI=>__('enum.KAPIDAKREDIKARTI'),
            self::MOBIL=>__('enum.MOBIL'),
            self::PAYPAL=>__('enum.PAYPAL'),
            self::PARCALI=>__('enum.PARCALI'),
            self::BAKIYE=>__('enum.BAKIYE'),
            self::ELDEN=>__('enum.ELDEN'),
            self::HESAPTAN=>__('enum.HESAPTAN'),
            self::N11=>__('enum.N11'),
            self::GG=>__('enum.GG'),
            self::HB=>__('enum.HB'),
            self::AMAZON=>__('enum.AMAZON'),
            self::HBBASEUS=>__('enum.HBBASEUS'),
            self::N11BASEUS=>__('enum.N11BASEUS'),
            self::TRENDYOL=>__('enum.TRENDYOL'),
            self::GGBASEUS=>__('enum.GGBASEUS'),
            self::GORDUMALDIMISBANKASI=>__('enum.GORDUMALDIMISBANKASI'),
            self::CICEKSEPETI=>__('enum.CICEKSEPETI'),
            self::MOTOKURYE=>__('enum.MOTOKURYE'),
        ];
        return isset($items[$const])?$items[$const]:$const;
    }
}
class PaymentStatus extends \Enum{
    const BEKLIYOR = 3;
    const ODENDI = 11;
    const ODENMEDI = 24;
    const IADE = 25;

    static function colors($class=null){
        return[
            self::ODENMEDI=>'danger',
            self::ODENDI=>'info',
            self::BEKLIYOR=>'warning',
            self::IADE=>'info',
        ];
    }
    static function color($const){
        $items = self::colors();
        if(isset($items[$const])){
            return $items[$const];
        }
        return '';
    }
    static function __($const){
        $items = [
            self::BEKLIYOR=>__('enum.BEKLIYOR'),
            self::ODENDI=>__('enum.ODENDI'),
            self::ODENMEDI=>__('enum.ODENMEDI'),
            self::IADE=>__('enum.IADE'),
        ];
        return isset($items[$const])?$items[$const]:$const;
    }

}
class UserRole extends \Enum{
    const ADMIN=1;
    const BAYI=2;
    const UYE=3;
    static function colors($class=null){
        return[
            self::ADMIN=>'danger',
            self::BAYI=>'warning',
            self::UYE=>'info',
        ];
    }
    static function color($const){
        $items = self::colors();
        if(isset($items[$const])){
            return $items[$const];
        }
        return '';
    }
}
class ShippingCompanies extends \Enum{
    const ARAS='aras';
    const MNG='mng';
    static function colors($class=null){
        return[
            self::ARAS=>'success',
            self::MNG=>'danger',
        ];
    }
    static function color($const){
        $items = self::colors();
        if(isset($items[$const])){
            return $items[$const];
        }
        return '';
    }
    static function __($const){
        $items = [
            self::ARAS=>'Aras Kargo',
            self::MNG=>'MNG Kargo',
        ];
        return isset($items[$const])?$items[$const]:$const;
    }

}
class ActivePassive extends \Enum{
    const ACTIVE=1;
    const PASSIVE=0;
    static function colors($class=null){
        return[
            self::ACTIVE=>'success',
            self::PASSIVE=>'danger',
        ];
    }
    static function color($const){
        $items = self::colors();
        if(isset($items[$const])){
            return $items[$const];
        }
        return '';
    }
    static function __($const){
        $items = [
            self::ACTIVE=>__('enum.ACTIVE'),
            self::PASSIVE=>__('enum.PASSIVE'),
        ];
        return isset($items[$const])?$items[$const]:$const;
    }
}
class YesNo extends \Enum{
    const YES=1;
    const NO=0;
    static function colors($class=null){
        return[
            self::YES=>'success',
            self::NO=>'danger',
        ];
    }
    static function color($const){
        $items = self::colors();
        if(isset($items[$const])){
            return $items[$const];
        }
        return '';
    }
}
class Enum
{
    static function list($class)
    {
        $list = [];
        $cClass = new $class();
        $oClass = new ReflectionClass($class);
        $items = $oClass->getConstants();
        foreach ($items as $item => $value) {
            $list[$value] = $cClass::__($value);
        }
        return $list;
    }

    static function colors($class = null)
    {
        return [];
    }

    static function color($const)
    {
        return '';
    }

    static function loadConst($endpoint = null)
    {
        if ($endpoint === null) $endpoint = request()->input('e');
        if ($endpoint) {
            $response = Webservice::get_endpoint($endpoint);

            if ($response) {
                foreach ($response as $item) {
                    $item['name'] = str_replace(['ğ', 'ü', 'ş', 'ı', 'ö', 'ç', 'Ğ', 'Ü', 'Ş', 'İ', 'Ö', 'Ç'], ['G', 'U', 'S', 'I', 'O', 'C', 'G', 'U', 'S', 'I', 'O', 'C'], $item['name']);
                    $item['name'] = str_replace([' ', "'", '"', '-', '(', ')', '/'], [''], $item['name']);
                    echo "const " . strtoupper($item['name']) . " = " . current($item) . ";<br>";
                }
                foreach ($response as $item) {
                    $name = $item['name'];
                    $item['name'] = str_replace(['ğ', 'ü', 'ş', 'ı', 'ö', 'ç', 'Ğ', 'Ü', 'Ş', 'İ', 'Ö', 'Ç'], ['G', 'U', 'S', 'I', 'O', 'C', 'G', 'U', 'S', 'I', 'O', 'C'], $item['name']);
                    $item['name'] = str_replace([' ', "'", '"', '-', '(', ')', '/'], [''], $item['name']);
                    echo "self::" . strtoupper($item['name']) . "=>'" . $name . "',<br>";
                }
            }
        }
    }
}
