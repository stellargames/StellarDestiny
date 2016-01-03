@extends('web')

@section('title')
    Navigation
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-6">
@include('client.partials.map')
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            @include('client.partials.controls')
        </div>
    </div>
@endsection

@section('scripts')
    {!! Html::script('/js/map.js') !!}
@endsection
