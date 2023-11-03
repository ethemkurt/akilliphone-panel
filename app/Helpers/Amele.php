<?php
function getProductImageUrl($url, $w=false, $h=false, $cdnx=false){

    $url = trim($url,'/');
    $parts = explode('/',$url);
    $port = isset($parts[0])?$parts[0]:'8004';
    $ports['up']='8000';
    $ports['up2']='8001';
    $ports['up3']='8002';
    $ports['upwater']='8003';
    $ports['img']='8004';
    unset($parts[0]);
    foreach($parts as $key=>$part){
        $parts[$key] = urlencode($part);
    }
    if($cdnx){
        $sub = 'https://cdn-x.akilliphone.com/';
    } else{
        $sub = env('CDN_URL', 'https://cdn.akilliphone.com/');
    }
    if(empty($w)) $w=160;
    if(empty($h)) $h=160;
    if($w && $h && isset($ports[$port]))
    {
        $result = $sub.$ports[$port].'/'.$w.'x'.$h.'/'.(implode('/',$parts));
    } else {
        $result = $sub.urlencode($url);
    }
    return $result;

}
function _HumanDate($date = NULL, $format = 'd.m.Y') {
    if ($date === NULL) $date = date('Y-m-d');
    return date($format, strtotime($date));
}
function _FormatPrice($price, $currency='TL'){
    $price = number_format(round($price, 2),2,',','.') ;
    return $price.''.$currency;
}
function _Asset($file){
    return url($file).'?_v='.time();
}
function _Image($file, $w='', $h=''){
    return '<img src="'._Asset('images/'.$file).'" width="'.$w.'" height="'.$h.'" >';
}
