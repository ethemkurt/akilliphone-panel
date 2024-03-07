<?php
$class = isset($attributes['class'])?$attributes['class']:'';
?>
<div class="form-check">
    <input type="checkbox" {{$checked}} class="form-check-input {{ $class }}" id="{{ $id }}" name="{{ $name }}" />
    <label class="form-check-label" for="{{ $id }}">{{ $label }}</label>
</div>
