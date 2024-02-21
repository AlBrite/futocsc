@props(['name','type','id', 'manual', 'onSelect', 'placeholder', 'attrs',

'bind_selected',
])
@php 
  $defaults = ['type'=>'text', 'manual'=>false, 'id'=>uniqid($name),'onSelect'=> null, 'placeholder'=>'','attrs'=>'',
  'bind_selected'=>''];
  foreach($defaults as $default => $value) {
    if (!isset($$default)) {
      $$default = $value;
    }
  }

$selection = uniqid('selection'.$name);
$bind_selected = "x-bind:selected=\"$bind_selected\"";
  
@endphp
<div x-data="{ {{$selection}} :null }">
  <span x-show="{{$selection}}!='manual'">
    <x-tooltip label="{{$placeholder}}">
      <select  class="input-sm" {!! $attrs !!} name="{{$name}}" id="{{$id}}" x-on:change="{{$selection}}=$el.value;{{$onSelect}}">
        <option value="">{{$placeholder}}</option>
        {{$slot}}

        @if($manual) 
          <option value="manual">Manual</option>
        @endif
      </select>
    </x-tooltip>
  </span>
  <span x-cloak x-show="{{$selection}}=='manual'">
    <x-input type="{{$type}}" placeholder="{{$placeholder}}" x-bind:name="{{$selection}}=='manual'?'{{$name}}':'{{$selection}}'"/>
  </span>
</div>