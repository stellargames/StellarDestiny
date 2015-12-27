@extends('web')

@section('title')
@if (!empty($edit->model->name))
{{ 'Edit user "' . $edit->model->name . '"' }}
@else
Create new user
@endif
@endsection

@section('content')
    {!! $edit !!}
@endsection
