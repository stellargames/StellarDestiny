@extends('web')

@section('title')
Reset password
@endsection

@section('content')
<form class="form-horizontal" method="POST" action="/password/reset">
    {!! csrf_field() !!}
    <input type="hidden" name="token" value="{{ $token }}">

    <div class="form-group @if ($errors->has('email')) has-error @endif">
        <div class="col-sm-offset-2 col-sm-4">
            <input class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="Email">
            @if ($errors->has('email')) <div class="text-danger">{{ $errors->first('email') }}</div> @endif
        </div>
    </div>

    <div class="form-group @if ($errors->has('password')) has-error @endif">
        <div class="col-sm-offset-2 col-sm-4">
            <input class="form-control" type="password" name="password" placeholder="New password">
            @if ($errors->has('password')) <div class="text-danger">{{ $errors->first('password') }}</div> @endif
        </div>
    </div>

    <div class="form-group @if ($errors->has('password_confirmation')) has-error @endif">
        <div class="col-sm-offset-2 col-sm-4">
            <input class="form-control" type="password" name="password_confirmation" placeholder="Confirm new password">
            @if ($errors->has('password_confirmation')) <div class="text-danger">{{ $errors->first('password_confirmation') }}</div> @endif
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-4">
            <button class="btn btn-default" id="inputSubmit" type="submit">Reset password</button>
        </div>
    </div>
</form>
@endsection
