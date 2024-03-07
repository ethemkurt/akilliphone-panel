<?php

class MarketPlaces extends \Enum{
    const AKILLIPHONE=10;
    const MOBILAPP=20;
    const TRENDYOL=110;
    const N11=120;
    const SAHIBINDEN=130;
    const CICEKSEPETI=140;
    const AMAZON=150;
    const HEPSIBURADA=160;
    const EPTTAVM=170;
    static function colors($class=null){
        return[];
    }
    static function color($const){
        $items = self::colors();
        if(isset($items[$const])){
            return $items[$const];
        }
        return 'info';
    }
}
class UserRole extends \Enum{
    const ADMIN = 1; // müdür ve muhasebe
    const UYE = 2;
    const BAYI = 3;
    //const SUPARADMIN = 4; // web servis yazılımcısı
    const TEMSILCI = 5; // kurum için depo elamanı personel
    static function __($value){
        $names =[
            self::ADMIN=>'Admin',
            self::BAYI=>'Bayi',
            self::UYE=>'Üye',
            self::TEMSILCI=>'Temsilci',
            //self::SUPARADMIN=>'Süper Admin',
        ];
        return isset($names[$value])?$names[$value]:$value;
    }
    static function colors($class=null){
        return[
            self::ADMIN=>'danger',
            self::BAYI=>'warning',
            self::UYE=>'info',
            self::TEMSILCI=>'info',
            //self::SUPARADMIN=>'info',
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
    const ARAS='Aras';
    const MNG='Mng';
    const TRYE='Trendyol Express Marketplace';
    static function colors($class=null){
        return[
            self::ARAS=>'success',
            self::MNG=>'danger',
            self::MNG=>'warning',
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
            self::TRYE=>'Trendyol Express Marketplace',
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

    static function __($value){
        return $value;
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
            $class = request()->input('c');
            if($class){
                $response = Webservice::get_endpoint($endpoint);
                echo htmlspecialchars('<?php')."<br>class $class extends \Enum{<br>";
                if ($response) {
                    foreach ($response as $item) {
                        $item['name'] = str_replace(['ğ', 'ü', 'ş', 'ı', 'ö', 'ç', 'Ğ', 'Ü', 'Ş', 'İ', 'Ö', 'Ç'], ['G', 'U', 'S', 'I', 'O', 'C', 'G', 'U', 'S', 'I', 'O', 'C'], $item['name']);
                        $item['name'] = str_replace([' ', "'", '"', '-', '(', ')', '/'], [''], $item['name']);
                        echo "const " . strtoupper($item['name']) . " = " . current($item) . ";<br>";
                    }
                    echo <<<HEREA
    static function colors(\$class=null){
        return [];
    }<br>
    static function color(\$const){<br>
        \$items = self::colors();<br>
        if(isset(\$items[\$const])){<br>
            return \$items[\$const];<br>
        }<br>
        return "success";<br>
    }<br>
    static function __(\$const){<br>\$items = [<br>
    HEREA;
                    foreach ($response as $item) {
                        $name = $item['name'];
                        $item['name'] = str_replace(['ğ', 'ü', 'ş', 'ı', 'ö', 'ç', 'Ğ', 'Ü', 'Ş', 'İ', 'Ö', 'Ç'], ['G', 'U', 'S', 'I', 'O', 'C', 'G', 'U', 'S', 'I', 'O', 'C'], $item['name']);
                        $item['name'] = str_replace([' ', "'", '"', '-', '(', ')', '/'], [''], $item['name']);
                        echo "self::" . strtoupper($item['name']) . "=>'" . $name . "',<br>";
                    }
                }
                echo "];<br> return isset(\$items[\$const])?\$items[\$const]:\$const;<br>}";
                echo "<br>}";

            }
        } else {
            $url = route('enum',['c'=>'PaymentType', 'e'=>'orders/payment-type']);
            echo '<a href="'.$url.'" target="_blank">'.$url.'</a><br>';
            $url = route('enum',['c'=>'PaymentStatus', 'e'=>'orders/payment-status']);
            echo '<a href="'.$url.'" target="_blank">'.$url.'</a><br>';
            $url = route('enum',['c'=>'OrderStatus', 'e'=>'orders/order-status']);
            echo '<a href="'.$url.'" target="_blank">'.$url.'</a><br>';
        }
    }
}
