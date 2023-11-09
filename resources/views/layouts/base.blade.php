<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
</head>
<body class="bg-body-secondary">
    <div class="container-fluid">
        @yield('header')

        @yield('main')

        @yield('footer')
    </div>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    @stack('js')
    
</body>
</html>