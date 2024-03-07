<?php
class OrderStatus extends \Enum{
    const ODEMEBEKLENIYOR = 1;
    const BEKLIYOR = 2;
    const ONAYLANDI = 3;
    const SIPARISHAZIRLANIYOR = 4;
    const ARASKARGOYAVERILDI = 5;
    const MNGKARGOYAVERILDI = 6;
    const SURATKARGOYAVERILDI = 7;
    const UPSKARGOYAVERILDI = 8;
    const YURTICIKARGOYAVERILDI = 9;
    const YANGOYAVERILDI = 10;
    const TESLIMEDILDI = 11;
    const IPTALEDILDI = 12;
    const IADEEDILDI = 13;
    const TEMINEDILIYOR = 14;
    const ULASILAMIYOR = 15;
    const INCELENIYOR = 16;
    const BASARISIZ = 17;
    const EKSIKSIPARIS = 18;
    const TELEFON = 19;
    const IADEDEGISIM = 20;
    const MAGAZAHAZIRLAYACAK = 21;
    const AVCILARHAZIRLAYACAK = 22;
    static function colors($class=null){ return []; }
    static function color($const){
        $items = self::colors();
        if(isset($items[$const])){
            return $items[$const];
        }
        return "success";
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
            self::YANGOYAVERILDI=>'YANGO\'ya Verildi',
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
