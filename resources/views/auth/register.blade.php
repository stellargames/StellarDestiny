@extends('web')

@section('title')
Register
@endsection

@section('content')

<form class="form-horizontal" method="POST" action="/auth/register">
    {!! csrf_field() !!}

    <div class="form-group @if ($errors->has('name')) has-error @endif">
        <div class="col-sm-offset-2 col-sm-4">
            <input class="form-control" type="text" name="name" value="{{ old('name') }}" placeholder="Name">
            @if ($errors->has('name')) <div class="text-danger">{{ $errors->first('name') }}</div> @endif
        </div>
    </div>

    <div class="form-group @if ($errors->has('email')) has-error @endif">
        <div class="col-sm-offset-2 col-sm-4">
            <input class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="Email">
            @if ($errors->has('email')) <div class="text-danger">{{ $errors->first('email') }}</div> @endif
        </div>
    </div>

    <div class="form-group @if ($errors->has('password')) has-error @endif">
        <div class="col-sm-offset-2 col-sm-4">
            <input class="form-control" type="password" name="password" placeholder="Password">
            @if ($errors->has('password')) <div class="text-danger">{{ $errors->first('password') }}</div> @endif
        </div>
    </div>

    <div class="form-group @if ($errors->has('password_confirmation')) has-error @endif">
        <div class="col-sm-offset-2 col-sm-4">
            <input class="form-control" type="password" name="password_confirmation" placeholder="Confirm password">
            @if ($errors->has('password_confirmation')) <div class="text-danger">{{ $errors->first('password_confirmation') }}</div> @endif
        </div>
    </div>

    <input type="text" name="agreement" id="inputAgreement" style="display: none" title="agreement">

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-4">
            <button class="btn btn-default" id="inputSubmit" type="submit">Register</button>
        </div>
    </div>
</form>
@endsection
