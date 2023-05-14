<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Lojistik Otomasyon | {{ $pageTitle ?? 'Tanımlanmamış Sayfa' }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
</head>

<body>
    @include('components.navbar')
    @yield('content')
    @yield('javascript')
</body>

</html>
