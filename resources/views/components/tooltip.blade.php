@props(['label'])

<span class="tooltip">
  {{$slot}}
  <span class="tooltip-label">{{$label}}</span>
</span>