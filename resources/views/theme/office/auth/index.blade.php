<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
         <!--begin::Fonts-->
         <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
         <link href="{{asset('offices/css/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
		 <link href="{{asset('offices/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
		 <link href="{{asset('offices/css/custom.css')}}" rel="stylesheet" type="text/css" />
         <title>{{$title}}</title>
    </head>
</head>
<body>
    {{$slot}}
    
    <script src="{{asset('offices/js/scripts.bundle.js') }}"></script>
    <script src="{{asset('offices/js/plugins.bundle.js') }}"></script>
    <script src="{{asset('offices/js/auth.js') }}"></script>
    {{-- <script src="{{asset('offices/js/plugin.js') }}"></script> --}}
    @yield('custom_js')
</body>
</html>