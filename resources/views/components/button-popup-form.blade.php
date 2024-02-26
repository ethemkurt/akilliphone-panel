<?php
$text = isset($text)?$text:'';
$url = isset($url)?$url:'';
$icon = isset($icon)?$icon:'plus';
$title = isset($title)?$title:'';
$class = isset($class)?$class:'btn-secondary ';
?>
<button type="button" class="btn {{ $class }} waves-effect waves-float waves-light btn-popup-form menu-link" data-bs-toggle="modal" data-bs-target="#poupForm" data-title="{{ $title }}" data-url="{{ $url }}"><i class="tf-icons ti ti-{{$icon}}" style="color: #FFFFFF"></i> {{ $text }}</button>
