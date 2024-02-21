@props(['placeholder', 'value', 'id', 'type', 'name', 'keyup', 'attrs'])
@php 
$defaults = ['placeholder'=>'', 'value'=>'', 'id'=>'', 'type'=>'text', 'name'=>'','keyup'=>'', 'attrs'=>''];
foreach($defaults as $key => $dvalue) {
  if (!isset($$key)) {
    $$key = $dvalue;
  }
}

@endphp
<fieldset class="flex flex-col relative input">
  <legend>
    {{$placeholder}}
  </legend>
  <input type="{{ $type }}" id="{{ $id }}" name="{{ $name }}" placeholder="{{ $placeholder }}" value="{{ $value }}" x-on:keyup="{{$keyup}}" {!!$attrs!!}>
</fieldset>