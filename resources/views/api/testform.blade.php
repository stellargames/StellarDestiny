@extends('web')

@section('title')
    STELLAR DESTINY
@endsection

@section('content')
    <form method="post" id="apiform">
        {{ csrf_field() }}
        <div class="form-group">
        <label>Command
            <input class="form-control" type="text" name="command" value="info"/>
        </label>
        </div>
        <div class="form-group">
        <label>Parameter
            <input class="form-control" type="text" name="arguments[]" value=""/>
        </label>
        <label>Value
            <input class="form-control" type="text" name="value" value=""/>
        </label>
        </div>
        <div class="form-group">
        <input type="submit" value="Execute"/>
        </div>
    </form>
    <textarea id="results" cols="120" rows="12"></textarea>
@endsection

@section('scripts')
    <script>
        $form = $('#apiform');

        $form.submit(function (e) {
            e.preventDefault();

            $.post('{{ action('ApiController@request') }}', $form.serialize())
                    .done(function( data ) {
                        $('#results').text( JSON.stringify(data) );
                        console.log(data);
                    });
        })
    </script>
@endsection
