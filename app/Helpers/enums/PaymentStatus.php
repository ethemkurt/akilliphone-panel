<?php
class PaymentStatus extends \Enum{
    const BEKLIYOR = 3;
    const ODENDI = 11;
    const ODENMEDI = 18;
    const IADE = 19;
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
            self::BEKLIYOR=>'Bekliyor',
            self::ODENDI=>'Ödendi',
            self::ODENMEDI=>'Ödenmedi',
            self::IADE=>'İade',
        ];
        return isset($items[$const])?$items[$const]:$const;
    }
}
