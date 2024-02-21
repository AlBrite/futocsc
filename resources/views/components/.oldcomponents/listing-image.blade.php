@props(['src'])
<img src="{{asset( $src ? 'storage/'.$src : 'images/no-image.png')}}"/>