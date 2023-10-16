<?php
$text = isset($text)?$text:'';
$url = isset($url)?$url:'';
$icon = isset($icon)?$icon:'edit';
$title = isset($title)?$title:'';
$class = isset($class)?$class:'btn-primary ';
?>
<button type="button" class="btn {{ $class }} waves-effect waves-float waves-light btn-popup-form" data-bs-toggle="modal" data-bs-target="#poupForm" data-title="{{ $title }}" data-url="{{ $url }}"><i class="fa fa-{{$icon}}"></i> {{ $text }}</button>
