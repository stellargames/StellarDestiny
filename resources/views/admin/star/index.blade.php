@extends('web')

@section('title')
Star administration
@endsection

@section('content')
    <ul>
        <li>Star count: {{ $starCount }}</li>
    </ul>
    <a href="{{ action('Admin\StarController@getGenerate') }}">Generate new galaxy.</a>
@endsection
