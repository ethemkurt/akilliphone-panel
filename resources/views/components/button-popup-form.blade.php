<?php
$text = isset($text)?$text:'Popup';
$url = isset($url)?$url:'';
$icon = isset($icon)?$icon:'edit';
$title = isset($title)?$title:'';
?>
<button type="button" class="btn btn-primary waves-effect waves-float waves-light btn-popup-form" data-bs-toggle="modal" data-bs-target="#poupForm" data-title="{{ $title }}" data-url="{{ $url }}"><i class="fa fa-{{$icon}}"></i> {{ $text }}</button>
