<?php
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
$enums = glob(dirname(__FILE__).'/enums/*.php');
foreach ($enums as $enum){
    include_once($enum);
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
echo "class OrderStatus extends \Enum{<br>";
echo "class OrderStatus extends \Enum{<br>";
            if ($response) {
                foreach ($response as $item) {
                    $item['name'] = str_replace(['ğ', 'ü', 'ş', 'ı', 'ö', 'ç', 'Ğ', 'Ü', 'Ş', 'İ', 'Ö', 'Ç'], ['G', 'U', 'S', 'I', 'O', 'C', 'G', 'U', 'S', 'I', 'O', 'C'], $item['name']);
                    $item['name'] = str_replace([' ', "'", '"', '-', '(', ')', '/'], [''], $item['name']);
                    echo "const " . strtoupper($item['name']) . " = " . current($item) . ";<br>";
                }
                echo <<<HEREA
    static function colors($class=null){
        return [];
    }
    static function color($const){
        $items = self::colors();
        if(isset($items[$const])){
            return $items[$const];
        }
        return \'success\';
    }
    HEREA;
                foreach ($response as $item) {
                    $name = $item['name'];
                    $item['name'] = str_replace(['ğ', 'ü', 'ş', 'ı', 'ö', 'ç', 'Ğ', 'Ü', 'Ş', 'İ', 'Ö', 'Ç'], ['G', 'U', 'S', 'I', 'O', 'C', 'G', 'U', 'S', 'I', 'O', 'C'], $item['name']);
                    $item['name'] = str_replace([' ', "'", '"', '-', '(', ')', '/'], [''], $item['name']);
                    echo "self::" . strtoupper($item['name']) . "=>'" . $name . "',<br>";
                }
            }
            echo "}";
        }
    }
}
