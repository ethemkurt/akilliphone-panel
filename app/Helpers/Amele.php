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
function _KargoBarkodu($orderId){
    return 1000000000000 + (int)$orderId;
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
    return url('assets/'.$file).'?_v='.time();
}
function _Image($file, $w='', $h=''){
    return '<img src="'._Asset('images/'.$file).'" width="'.$w.'" height="'.$h.'" >';
}
function _ReturnSucces($message, $html, $redirect=''){
    $data['status'] = 1;
    $data['message'] = $message;
    $data['html'] = $html;
    $data['redirect'] = $redirect;
    $data['refreshTable'] = true;
    return _ReturnResponse($data);
}
function _ReturnError($message, $html, $errors=[]){
    $data['status'] = 0;
    $data['message'] = $message;
    $data['html'] = $html;
    $data['errors'] = implode('<br>', $errors);
    $data['refreshTable'] = false;
    return _ReturnResponse($data);
}
function _ReturnResponse($data){
    $data['status'] = isset($data['status'])?$data['status']:1;
    $data['date'] = date('Y-m-d H:i:s');
    $data['ver'] = env('VER','1.0.0');
    $data['message'] = isset($data['message'])?$data['message']:'';
    $data['html'] = isset($data['html'])?$data['html']:'';
    $data['errors'] = isset($data['errors'])?$data['errors']:'';
    $data['redirect'] = isset($data['redirect'])?$data['redirect']:'';
    return $data;
}
function _formatPhoneNumber($phoneNumber) {
    $phoneNumber = preg_replace('/[^0-9]/','',$phoneNumber);

    if(strlen($phoneNumber) > 10) {
        $countryCode = substr($phoneNumber, 0, strlen($phoneNumber)-10);
        $areaCode = substr($phoneNumber, -10, 3);
        $nextThree = substr($phoneNumber, -7, 3);
        $lastDouble1 = substr($phoneNumber, -4, 2);
        $lastDouble2 = substr($phoneNumber, -2, 2);

        $phoneNumber = '+'.$countryCode.' ('.$areaCode.') '.$nextThree.' '.$lastDouble1.' '.$lastDouble2;
    }
    else if(strlen($phoneNumber) == 10) {
        $areaCode = substr($phoneNumber, 0, 3);
        $nextThree = substr($phoneNumber, 3, 3);
        $lastDouble1 = substr($phoneNumber, 6, 2);
        $lastDouble2 = substr($phoneNumber, 8, 2);

        $phoneNumber = '('.$areaCode.') '.$nextThree.' '.$lastDouble1.' '.$lastDouble2;
    }
    else if(strlen($phoneNumber) == 7) {
        $nextThree = substr($phoneNumber, 0, 3);
        $lastDouble1 = substr($phoneNumber, 3, 2);
        $lastDouble2 = substr($phoneNumber, 5, 2);
        $phoneNumber = $nextThree.' '.$lastDouble1.' '.$lastDouble2;
    }

    return $phoneNumber;
}
function _CdnImageUrl($url, $w=false, $h=false, $cdnx=false ){
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
        $sub = env('CDN_URL');
    }
    if(empty($w)) $w=40;
    if(empty($h)) $h=40;
    if($w && $h && isset($ports[$port]))
    {
        $result = $sub.$ports[$port].'/'.$w.'x'.$h.'/'.(implode('/',$parts));
    } else {
        $result = $sub.urlencode($url);
    }
    return $result;
}
function validateRole($required=null){
    if($required==null){
        return true;
    }
    if($required==CURRENT_ROLE){
        return true;
    }
    if($required==UserRole::TEMSILCI && CURRENT_ROLE == UserRole::ADMIN){
        return true;
    }
    return false;
}
function _ProfileUserAvatar($user){

    $firstname = mb_substr($user['firstName'],0,1);
    $lastname = mb_substr($user['lastName'],0,1);

    return '<a class="nav-link dropdown-toggle hide-arrow show" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
              <div class="avatar avatar-online">
               <span class="avatar-initial rounded-circle  bg-label-dark">'.$firstname.$lastname.'</span></div>
            </a>';
}
function _OrderUserAvatar($order){
    $firstname = $order['shippingAddress']['firstname'];
    $lastname = $order['shippingAddress']['lastname'];
    $email = $order['orderCustomer']?$order['orderCustomer']['email']:'';
    $url = route('order.view', $order['orderId']);
    return _UserAvatar($firstname, $lastname, $email, $url);
}
function _UserAvatar($firstname, $lastname, $email, $url){
    return '<div class="d-flex justify-content-start align-items-center order-name text-nowrap"><div class="avatar-wrapper"><div class="avatar me-2"><span class="avatar-initial rounded-circle  bg-label-dark">'.mb_substr($firstname,0,1).mb_substr($lastname,0,1).'</span></div></div><div class="d-flex flex-column"><h6 class="m-0"><a class="text-body" target="_blank" href="'.$url.'">'.$firstname.' '.$lastname.'</a></h6><small class="text-muted">'.$email.'</small></div></div>';
}
