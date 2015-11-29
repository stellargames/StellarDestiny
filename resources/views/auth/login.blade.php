@extends('web')

@section('title')
Login
@endsection

@section('content')
    <form class="form-horizontal" method="POST" action="/auth/login">
        {!! csrf_field() !!}

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

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-4">
                <div class="checkbox">
                    <label>
                <input type="checkbox" name="remember">Remember me
                    </label>
                </div>
            </div>
        </div>

        <div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-4">
                    <button class="btn btn-default" type="submit">Login</button>
                    <small><a href="{{ url('/password/email') }}">Forgot Your Password?</a></small>
                </div>
            </div>
        </div>
    </form>
@endsection
