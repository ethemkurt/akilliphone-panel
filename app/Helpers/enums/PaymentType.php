<?php
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
