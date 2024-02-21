@props(['tags'])
@if ($tags)
    @php
        $tags = array_map('trim', explode(',', $tags));
    @endphp
    <div class="d-flex justify-content-center">
        @foreach ($tags as $tag)
        <a href="/?tag={{$tag}}" class="badge badge-pill badge-primary mx-2">
            {{$tag}}
        </a>
        @endforeach
    </div>
    
@endif