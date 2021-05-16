<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <title>Seventh</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico') }}">
    <link href="{{ URL::asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />    
    @include('console-service::layouts.shared.head')
    <style>
        .danger {
            color: red;
        }
    </style>
</head>
<body>
    @yield('content')
    @include('console-service::layouts.shared.footer-script')
</body>
</html>