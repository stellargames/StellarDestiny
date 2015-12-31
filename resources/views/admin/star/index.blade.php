@extends('web')

@section('title')
Star administration
@endsection

@section('content')
    <ul>
        <li>Star count: {{ $starCount }}</li>
        <li>Star link count: {{ $starLinkCount }}</li>
    </ul>
    <a href="{{ action('Admin\StarController@generate') }}">Generate new galaxy.</a>
@endsection
