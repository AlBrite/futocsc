@props(['class'])

<div  x-show="showInfo" x-transition id="details" class="ffixed top-12 right-0 bg-white flex-col gap-2 overflow-y-auto w-80 p-2 shadow-lg
    lg:h-[100%] lg:relative lg:top-0 lg:shadow-none lg:p-1 lg:col-span-1 lg:w-auto
    xl:col-span-2 lg:flex">{{$slot}}</div>
                  