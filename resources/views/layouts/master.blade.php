<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title')</title>

    @include('partials.styles')
</head>
<body>
    @include('partials.header')

    @yield('content')

    @include('partials.footer')

    @include('partials.scripts')
</body>
</html>