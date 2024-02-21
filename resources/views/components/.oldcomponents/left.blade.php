@props(['class'])
<div class="lg:col-span-2 lg:h-[100%] lg:overflow-y-auto select-none xl:col-span-5 {{isset($class)?$class:''}}">
    {{$slot}}
</div>
                    