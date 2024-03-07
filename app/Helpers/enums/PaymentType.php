<?php
class PaymentType extends \Enum{
    const KREDIKARTI = 1;
    const HAVALE = 2;
    const KAPIDANAKIT = 3;
    const KAPIDAKREDIKARTI = 4;
    const MOBIL = 5;
    const PAYPAL = 6;
    const PARCALI = 7;
    const BAKIYE = 8;
    const ELDEN = 9;
    const HESAPTAN = 10;
    const N11 = 11;
    const GG = 12;
    const HB = 13;
    const AMAZON = 14;
    const HBBASEUS = 15;
    const N11BASEUS = 16;
    const TRENDYOL = 17;
    const GGBASEUS = 18;
    const GORDUMALDIMISBANKASI = 19;
    const CICEKSEPETI = 20;
    const MOTOKURYE = 21;
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
            self::KREDIKARTI=>'Kredi Kartı',
            self::HAVALE=>'Havale',
            self::KAPIDANAKIT=>'Kapıda Nakit',
            self::KAPIDAKREDIKARTI=>'Kapıda Kredi Kartı',
            self::MOBIL=>'Mobil',
            self::PAYPAL=>'Paypal',
            self::PARCALI=>'Parçalı',
            self::BAKIYE=>'Bakiye',
            self::ELDEN=>'Elden',
            self::HESAPTAN=>'Hesaptan',
            self::N11=>'n11',
            self::GG=>'GG',
            self::HB=>'HB',
            self::AMAZON=>'Amazon',
            self::HBBASEUS=>'HB-BASEUS',
            self::N11BASEUS=>'N11-BASEUS',
            self::TRENDYOL=>'TRENDYOL',
            self::GGBASEUS=>'GG-BASEUS',
            self::GORDUMALDIMISBANKASI=>'GÖRDÜM ALDIM (İşbankası)',
            self::CICEKSEPETI=>'Çiçek Sepeti',
            self::MOTOKURYE=>'MOTO KURYE',
        ];
        return isset($items[$const])?$items[$const]:$const;
    }
    static function icon($const=null){
        $items = [
            self::KREDIKARTI=> _Asset('img/icons/payments/mastercard.png'),
            self::HAVALE=> _Asset('img/icons/payments/cash.png'),
            self::KAPIDANAKIT=> _Asset('img/icons/payments/cash.png'),
            self::KAPIDAKREDIKARTI=> _Asset('img/icons/payments/cash.png'),
            self::MOBIL=> _Asset('img/icons/payments/cash.png'),
            self::PAYPAL=> _Asset('img/icons/payments/cash.png'),
            self::PARCALI=> _Asset('img/icons/payments/cash.png'),
            self::BAKIYE=> _Asset('img/icons/payments/cash.png'),
            self::ELDEN=> _Asset('img/icons/payments/cash.png'),
            self::HESAPTAN=> _Asset('img/icons/payments/cash.png'),
            self::N11=> _Asset('img/icons/payments/cash.png'),
            self::GG=> _Asset('img/icons/payments/cash.png'),
            self::HB=> _Asset('img/icons/payments/cash.png'),
            self::AMAZON=> _Asset('img/icons/payments/cash.png'),
            self::HBBASEUS=> _Asset('img/icons/payments/cash.png'),
            self::N11BASEUS=> _Asset('img/icons/payments/cash.png'),
            self::TRENDYOL=> _Asset('img/icons/payments/cash.png'),
            self::GGBASEUS=> _Asset('img/icons/payments/cash.png'),
            self::GORDUMALDIMISBANKASI=> _Asset('img/icons/payments/cash.png'),
            self::CICEKSEPETI=> _Asset('img/icons/payments/cash.png'),
            self::MOTOKURYE=> _Asset('img/icons/payments/cash.png'),
        ];
        return isset($items[$const])?$items[$const]:$const;
    }

}
