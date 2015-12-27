@extends('web')

@section('title')
    STELLAR DESTINY
@endsection

@section('content')
    <form method="post" action="{{ action('ApiController@request') }}">
        {{ csrf_field() }}
        <input type="submit"/>
    </form>
@endsection
