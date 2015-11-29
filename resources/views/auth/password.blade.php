@extends('web')

@section('title')
Password reset
@endsection

@section('content')
<form class="form-horizontal" method="POST" action="/password/email">
    {!! csrf_field() !!}

    <div class="form-group @if ($errors->has('email')) has-error @endif">
        <div class="col-sm-offset-2 col-sm-4">
            <input class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="Email">
            @if ($errors->has('email')) <div class="text-danger">{{ $errors->first('email') }}</div> @endif
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-4">
            <button class="btn btn-default" id="inputSubmit" type="submit">Send Password Reset Link</button>
        </div>
    </div>
</form>
@endsection
