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
