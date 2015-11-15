@extends('web')

@section('content')
<form method="POST" action="/auth/register">
    {!! csrf_field() !!}
    @if ( $errors->any() )
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
            Name
            <input type="text" name="name" value="{{ old('name') }}">
        </label>
    </div>

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

    <input type="text" name="agreement" style="display: none" title="agreement">

    <div>
        <button type="submit">Register</button>
    </div>
</form>
@endsection