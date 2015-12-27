<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Stellar Destiny</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">

    {!! Rapyd::styles() !!}
    <link rel="stylesheet" href="/css/all.css">

</head>
<body>
<div class="container">
    <div class="row">
        @include('partials.nav')
    </div>
    <div class="row">
        <h1 class="col-sm-offset-2">@yield('title')</h1>
    </div>
    @if(Session::has('notification'))
        <div>{{ Session::get('notification') }}</div>
    @endif

    @if (session('status'))
        <div class="row">
            <div class="col-sm-offset-2 col-sm-4 alert alert-success">
                {{ session('status') }}
            </div>
        </div>
    @endif
    <div class="row">
        @yield('content')
    </div>
</div>

<script src="//code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
{!! Rapyd::scripts() !!}
<script>$('[data-toggle="tooltip"]').tooltip();</script>
</body>
</html>
