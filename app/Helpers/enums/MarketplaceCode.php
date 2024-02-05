<?php
class MarketplaceCode extends \Enum{
    const N11 = 'N11';
    const AMAZON = 'AMAZON';
    const CCKSPT = 'CCKSPT';
    const HPSBRD = 'HPSBRD';
    const TRDNYL = 'TRDNYL';
    const AKLLPHN = 'AKLLPHN';
    const WECRT = 'WECRT';

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
            self::N11=>'N11',
            self::AMAZON=>'Amazon',
            self::CCKSPT=>'Çiçek Sepeti',
            self::HPSBRD=>'Hepsi Burada',
            self::TRDNYL=>'Trendyol',
            self::AKLLPHN=>'Akıllıphone',
            self::WECRT=>'Wecart'
        ];
        return isset($items[$const])?$items[$const]:$const;
    }
}
