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
function poupFormButton($url, $text, $title='', $class='btn-primary' ){
    return \Illuminate\Support\Facades\Blade::render('<x-button-popup-form :title="\''.$title.'\'" :text="\''.$text.'\'" :url="\''.$url.'\'" :class="\''.$class.'\'" />') ;
}
function returnSucces($data, $message=''){
    return [
        'status'=>1,
        'message'=>$message,
        'html'=>isset($data['html'])?$data['html']:'',
        'data'=>$data,
        'errors'=>[],
    ];
}
function returnError($errors, $message=''){
    return [
        'status'=>0,
        'message'=>$message,
        'html'=>'',
        'data'=>[],
        'errors'=>implode('<br>', $errors),
    ];
}

