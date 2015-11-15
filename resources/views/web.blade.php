<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {{--<meta name="viewport" content="width=device-width, initial-scale=1">--}}
    <title>Stellar Destiny</title>

    <link href="{{ asset('/css/all.css') }}" rel="stylesheet">

</head>
<body>
@include('partials.nav')

@if(Session::has('notification'))
    <div>{{ Session::get('notification') }}</div>
@endif

<div class="container">
    @yield('content')
</div>

<script src="/js/all.js"></script>
</body>
</html>