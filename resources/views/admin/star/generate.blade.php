@extends('web')

@section('title')
Star administration
@endsection

@section('content')
    <form class="form-horizontal" method="POST" action="{{ action('Admin\StarController@postGenerate') }}">
        {!! csrf_field() !!}

        <div class="form-group @if ($errors->has('amount')) has-error @endif">
            <div class="col-sm-offset-2 col-sm-4">
                <input class="form-control" type="text" name="amount" value="{{ old('amount') }}" placeholder="Amount">
                @if ($errors->has('amount')) <div class="text-danger">{{ $errors->first('amount') }}</div> @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-4">
                <button class="btn btn-default" id="inputSubmit" type="submit">Generate</button>
            </div>
        </div>
    </form>
@endsection
