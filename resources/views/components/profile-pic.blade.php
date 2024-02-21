@props(['user', 'placeholder', 'height', 'width', 'class', 'style', 'id'])



@php
    
    $image = 'images/avatar-u.png';
    if ($user) {
        $placeholder ??= 'image';
        $image = match (true) {
            !!$user->$placeholder => 'storage/' . $user->$placeholder,
            $user->gender === 'female' => 'images/avatar-f.png',
            $user->gender === 'male' => 'images/avatar-m.png',
            default => 'images/avatar-u.png',
        };
    }
    $class = isset($class) ? " class='" . htmlspecialchars($class) . "'" : '';
    $height = isset($height) ? " height='" . htmlspecialchars($height) . "'" : '';
    $width = isset($width) ? " width='" . htmlspecialchars($width) . "'" : '';
    $style = isset($style) ? " style='" . htmlspecialchars($style) . "'" : '';
    $id = isset($id) ? " id='" . htmlspecialchars($id) . "'" : '';
    
@endphp

<img src="{{ asset($image) }}" {!! $class . $style . $height . $width . $id !!} />
