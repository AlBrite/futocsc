@props(['name', 'alpine'])
@php 
if (!isset($alpine)) {
  $alpine = '';
}
@endphp
<div class="justify-self-center">
  <x-tooltip label="Choose or Drag Image here">
    <input type="file" id="fileInput" accepts="image/*" style="display: none;">
    <div id="dropZone" class="drop-zone flex flex-col items-center rounded-md  justify-center">
        <img src="{{asset('svg/icons/image.svg')}}" {!!$alpine!!}class="w-full h-full object-cover"/>
        <p class="text-sm opacity-55">Drag & Drop image here</p>
    </div>
  </x-tooltip>
</div>