<?php
$class = isset($attributes['class'])?$attributes['class']:'';
?>
<label class="form-label" for="{{ $name }}">{{ $label }}</label>
<input
  type="text"
  class="form-control {{ $class }}"
  id="{{ $name }}"
  name="{{ $name }}"
  placeholder="{{ $placeholder }}"
/>
