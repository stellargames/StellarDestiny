@extends('web')

@section('content')
<form method="POST" action="/password/reset">
    {!! csrf_field() !!}
    <input type="hidden" name="token" value="{{ $token }}">

    @if (count($errors) > 0)
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div>
        <label>
        Email
            <input type="email" name="email" value="{{ old('email') }}">
        </label>
    </div>

    <div>
        <label>
        Password
            <input type="password" name="password">
        </label>
    </div>

    <div>
        <label>
            Confirm Password
            <input type="password" name="password_confirmation">
        </label>
    </div>

    <div>
        <button type="submit">
            Reset Password
        </button>
    </div>
</form>
@endsection
