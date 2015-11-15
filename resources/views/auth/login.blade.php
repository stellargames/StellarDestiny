@extends('web')

@section('content')
    @if (count($errors) > 0)
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="/auth/login">
        {!! csrf_field() !!}

        <div>
            <label>
                Email
                <input type="email" name="email" value="{{ old('email') }}">
            </label>
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password"/>
        </div>

        <div>
            <label>
                <input type="checkbox" name="remember">
                Remember Me
            </label>
        </div>

        <div>
            <button type="submit">Login</button>
            <a href="{{ url('/password/email') }}">Forgot Your Password?</a>
        </div>
    </form>
@endsection
