<?php
class PaymentType extends \Enum{
    const KREDIKARTI = 1 ;
    const HAVALE = 2 ;
    const KAPIDANAKIT = 3 ;
    const KAPIDAKREDIKARTI= 4 ;
    const MOBIL = 5;
    const PAYPAL = 6;
    const PARCALI = 7;
    const BAKIYE = 8;
    const ELDEN = 9;
    const HESAPTAN = 10;
    const N11 = 20;
    const GG = 21;
    const HB = 22;
    const AMAZON = 23;
    const HBBASEUS = 24;
    const N11BASEUS = 25;
    const TRENDYOL = 26;
    const GGBASEUS = 27;
    const GORDUMALDIM = 28;
    const CICEKSEPETI = 29;
    const MOTOKURYE = 31;
    static function colors($class=null){
        return[];
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
            self::KREDIKARTI=>__('enum.KREDIKARTI'),
            self::HAVALE=>__('enum.HAVALE'),
            self::KAPIDANAKIT=>__('enum.KAPIDANAKIT'),
            self::KAPIDAKREDIKARTI=>__('enum.KAPIDAKREDIKARTI'),
            self::MOBIL=>__('enum.MOBIL'),
            self::PAYPAL=>__('enum.PAYPAL'),
            self::PARCALI=>__('enum.PARCALI'),
            self::BAKIYE =>__('enum.COD'),
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
            self::GORDUMALDIM=>__('enum.GORDUMALDIM'),
            self::CICEKSEPETI=>__('enum.CICEKSEPETI'),
            self::MOTOKURYE=>__('enum.MOTOKURYE'),
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
    static function list($class){
        $list = [];
        $oClass = new ReflectionClass($class);
        $items = $oClass->getConstants();
        foreach ($items as $item => $value) {
            $list[$value] = __('enum.' . $item);
        }
        return $list;
    }

    static function colors($class=null)
    {
        return [];
    }
    static function color($const)
    {
        return '';
    }
}
