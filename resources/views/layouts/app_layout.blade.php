<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | {{config('app.name')}}</title>
    <meta name="description" content="ユーザー匿名性掲示板">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="/js/app.js" defer></script>
</head>
<body>
<x-header></x-header>
@yield('content')
</body>
</html>
