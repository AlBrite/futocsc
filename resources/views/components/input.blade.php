@props(['type','placeholder', 'disabled', 'value', 'name', 'pattern'])

@php 

use Illuminate\Support\Arr;


$defaults = [
  'type' => 'text',
  'placeholder' => null,
  'value' => null,
  'disabled' => false,
  'pattern' => '([a-zA-Z0-9]+)',
  'name' => ''
  ];
  foreach($defaults as $default => $default_value) {
    if(!isset($$default) || !$$default) {
      $$default = $default_value;
    }
  }

  
  $patterns = [
    'number' => '^(\\d+)$',
    'email' => '^([a-zA-Z]+)@([a-zA-Z+])\\.([a-zA-Z]+)$'
    ];
  if (!$patterns && Arr::exists($patterns, $pattern)) {
    $pattern =  $patterns[$pattern];
  }
  $handleOnchange = "valid=null";
  if ($pattern) {
    $handleOnchange = "valid=(new RegExp('{$pattern}')).test(\$el.value)";
  }

  $data = ["valid"=>null];
  
  
  if ($type === 'password') {
    $toggleVisibility = "visible=!";
    $data["visible"] = false;
  }
  $disabled = !!$disabled;
  $disabled_attr = $disabled ? 'disabled="disabled"':'';
  
  $disabled = $disabled ? 'true':'false';
  $encodedData = json_encode($data);
  //dd($handleOnchange);
@endphp
<fieldset :class="{'focused': focused, 'disabled': {{$disabled}}}" class="input-2" x-data="{ disabled: {{$disabled}}, value: '{{$value}}', valid: null, visible:false, placeholder: {{$placeholder?'"'.$placeholder.'"':null}}, focused:false}">
  <legend :class="{'focused-legend':focused}" x-show="focused && placeholder" for="{{$name}}_input-2" x-text="placeholder"></legend>
  
  <div class="flex w-full justify-between items-center">
    <div class="flex-1">
     
      <input 
      
      type="{{$type}}"
      x-bind:type="'{{$type}}'=='password'?(visible?'text':'password'):'{{$type}}'"
      x-bind:class="{'pr-4':!valid || '{{$type}}'=='password'}"
      name="{{$name}}" 
          x-bind:placeholder="focused?'':placeholder"
      value="{{$value}}"
          placeholder="{{strlen(trim($value)) > 0 ?$value : $placeholder}}" 
          id="{{$name}}_input-2" 
          x-on:focus="focused=true;"
          x-on:blur="focused=false;"
          x-on:keyup="{{$handleOnchange}}"
          autocapitalize="none" 
          autocorrect="false" 
          {!! $disabled_attr !!}
      >
    </div>
    
    @if($type == 'password')
        <div class="pl-2 pr-4">
          <span class="block" x-on:click="visible=!visible;setTimeout(() => visible = false, 1000);">
              <span x-show="!visible" class="toggle-password flex items-center gap-1">
                  <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="eye" class="svg-inline--fa fa-eye fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" width="15" height="14" viewBox="0 0 640 512"><path fill="currentColor" d="M288 144a110.94 110.94 0 0 0-31.24 5 55.4 55.4 0 0 1 7.24 27 56 56 0 0 1-56 56 55.4 55.4 0 0 1-27-7.24A111.71 111.71 0 1 0 288 144zm284.52 97.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400c-98.65 0-189.09-55-237.93-144C98.91 167 189.34 112 288 112s189.09 55 237.93 144C477.1 345 386.66 400 288 400z"></path></svg> 
              </span>
              <span x-cloak x-show="visible" class="toggle-password flex items-center gap-1">
                  <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="eye-slash" role="img" xmlns="http://www.w3.org/2000/svg" width="15" height="14" viewBox="0 0 640 512"><path  fill="currentColor" d="M634 471L36 3.51A16 16 0 0 0 13.51 6l-10 12.49A16 16 0 0 0 6 41l598 467.49a16 16 0 0 0 22.49-2.49l10-12.49A16 16 0 0 0 634 471zM296.79 146.47l134.79 105.38C429.36 191.91 380.48 144 320 144a112.26 112.26 0 0 0-23.21 2.47zm46.42 219.07L208.42 260.16C210.65 320.09 259.53 368 320 368a113 113 0 0 0 23.21-2.46zM320 112c98.65 0 189.09 55 237.93 144a285.53 285.53 0 0 1-44 60.2l37.74 29.5a333.7 333.7 0 0 0 52.9-75.11 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64c-36.7 0-71.71 7-104.63 18.81l46.41 36.29c18.94-4.3 38.34-7.1 58.22-7.1zm0 288c-98.65 0-189.08-55-237.93-144a285.47 285.47 0 0 1 44.05-60.19l-37.74-29.5a333.6 333.6 0 0 0-52.89 75.1 32.35 32.35 0 0 0 0 29.19C89.72 376.41 197.08 448 320 448c36.7 0 71.71-7.05 104.63-18.81l-46.41-36.28C359.28 397.2 339.89 400 320 400z"></path></svg> 
              </span>
          </span>
        </div>


    @else 
      <div class="pl-2 pr-4" x-cloak x-show="valid">
        <svg width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M11.8541 0.145917C11.9007 0.192363 11.9376 0.247538 11.9629 0.308284C11.9881 0.369029 12.001 0.43415 12.001 0.499917C12.001 0.565685 11.9881 0.630806 11.9629 0.691551C11.9376 0.752296 11.9007 0.807472 11.8541 0.853917L4.85414 7.85392C4.8077 7.90048 4.75252 7.93742 4.69178 7.96263C4.63103 7.98784 4.56591 8.00081 4.50014 8.00081C4.43438 8.00081 4.36925 7.98784 4.30851 7.96263C4.24776 7.93742 4.19259 7.90048 4.14614 7.85392L0.646143 4.35392C0.552257 4.26003 0.499512 4.13269 0.499512 3.99992C0.499512 3.86714 0.552257 3.7398 0.646143 3.64592C0.74003 3.55203 0.867368 3.49929 1.00014 3.49929C1.13292 3.49929 1.26026 3.55203 1.35414 3.64592L4.50014 6.79292L11.1461 0.145917C11.1926 0.0993539 11.2478 0.0624112 11.3085 0.0372047C11.3693 0.0119983 11.4344 -0.000976563 11.5001 -0.000976562C11.5659 -0.000976562 11.631 0.0119983 11.6918 0.0372047C11.7525 0.0624112 11.8077 0.0993539 11.8541 0.145917Z" fill="#28A745"></path>
        </svg>
      </div>
    @endif

  </div>
</fieldset>