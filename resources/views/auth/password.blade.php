@extends('web')

@section('content')
<form method="POST" action="/password/email">
    {!! csrf_field() !!}

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
        <button type="submit">
            Send Password Reset Link
        </button>
    </div>
</form>
@endsection