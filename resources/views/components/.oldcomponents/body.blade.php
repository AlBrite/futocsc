@props(['sidebar', 'title', 'description', 'image', 'page'])
@php
    if (empty($title)) {
        $title = 'CSC Portal';
    }
    if (empty($description)) {
        $description = 'Chirpie empowers you to converse with friends and others';
    }
    if (auth()->check()) {
        $title .= ' - ' . ucfirst(auth()->user()->role);
    }
    
@endphp

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>{{ $title }}</title>
    <link id="favicon" rel="icon" href="{{ asset('images/favicon.ico') }}">
    <meta name="title" content="{{ $title }}">
    <script nonce="">
        function checkNetworkStatus() {
            var icon = "{{ asset('favicon.ico') }}";
            if (navigator.onLine) {
                icon = "{{ asset('/_favicon.ico') }}";
            }

            let favicon = document.getElementById("favicon");
            favicon.href = icon;
        }

        checkNetworkStatus();
        window.addEventListener("online", checkNetworkStatus);
        window.addEventListener("offline", checkNetworkStatus);

        ;
    </script>
    <meta name="description" content="{{ $description }}">
    <meta name="og:description" content="{{ $description }}">
    <meta name="og:title" content="{{ $title }}">
    <meta name="referrer" content="no-referrer">
    <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        .form-300 {
            width: 300px;
            margin: auto;
        }
    </style>

</head>

<body style="background:#f1f0f0" class="p-4">
    <x-flash-message />
    <div id="loading-svg" class="d-none" style="display: none;">
        <svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://wwww.w3.org/2000/svg">
            <path fill="#000"
                d="M50,10c22.1,0,40,17.9,40,40s-17.9,40-40,40s-40-17.9-40-40S27.9,10,50,10z M50,90c19.3,0,35-15.7,35-35s-15.7-35-35-35S15,35.7,15,55S30.7,90,50,90z">
                <animateTransform attributeName="transform" type="rotate" from="0 50 50" to="360 50 50" dur="0.5s"
                    repeatCount="indefinite"></animateTransform>
            </path>
        </svg>
    </div>
    <x-header />


    {{ $slot }}



    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>


    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-typeahead.js') }}"></script>
    </div>
    <script>
        $(function() {
            $('input[type=date][data-value]').each(function() {
                var date = $(this).val();
                if (/([0-9]+){4,3}-([0-9]+){2,2}-([0-9]+){2,2}/.test(date)) {
                    var defaultDate = new Date(date);
                    var formattedDate = defaultDate.toISOString().split('T')[0];
                    $(this).val(formattedDate);
                }
            });
        });
    </script>

</body>

</html>
