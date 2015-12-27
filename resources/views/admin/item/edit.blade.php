@extends('web')

@section('title')
@if (!empty($edit->model->name))
{{ 'Edit item "' . $edit->model->name . '"' }}
@else
Create new item
@endif
@endsection

@section('content')
    {!! $edit !!}
@endsection
