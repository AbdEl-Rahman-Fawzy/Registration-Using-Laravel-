<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    
</head>
<body>
    @include('layout.header')

    <div class="container">
        @yield('content')
    </div>

    @include('layout.footer')

    <script src="{{ asset('API_Ops.js') }}"></script>
    <script src="{{ asset('clientValidations.js') }}"></script>
</body>
</html>