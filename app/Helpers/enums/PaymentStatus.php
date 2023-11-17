<?php
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

