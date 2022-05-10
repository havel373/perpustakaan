<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="{{asset('offices/vendor_sb/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{asset('offices/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{asset('offices/css/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{asset('offices/css/toastr.css') }}" rel="stylesheet">
    <link href="{{asset('offices/css/confirm.css') }}" rel="stylesheet">
    <link href="{{asset('offices/css/custom.css') }}" rel="stylesheet">
    @yield('custom_css')
    <title>{{$title}}</title>
</head>