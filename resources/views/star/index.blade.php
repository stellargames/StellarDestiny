@extends('web')

@section('title')
Star administration
@endsection

@section('content')
    <ul>
        <li>Star count: {{ $star_count }}</li>
        <li>Star link count: {{ $star_link_count }}</li>
    </ul>
    <a href="{{ action('Admin\StarController@generate') }}">Generate new galaxy.</a>
@endsection
