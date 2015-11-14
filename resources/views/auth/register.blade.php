<!-- resources/views/auth/register.blade.php -->

<form method="POST" action="/register">
    {!! csrf_field() !!}
    @if ( $errors->any() )
        @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach
    @endif
    <div>
        Name
        <input type="text" name="name" value="{{ old('name') }}">
    </div>

    <div>
        Email
        <input type="email" name="email" value="{{ old('email') }}">
    </div>

    <div>
        Password
        <input type="password" name="password">
    </div>

    <div>
        Confirm Password
        <input type="password" name="password_confirmation">
    </div>

    <div>
        <button type="submit">Register</button>
    </div>
</form>