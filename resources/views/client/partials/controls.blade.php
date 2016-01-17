<script>
    var elements = {!! json_encode($player->ship->location) !!}
</script>
<h2>Controls</h2>
<form method="post">
    {!!  csrf_field() !!}
    <ul>
        @foreach($player->ship->location->exits as $name)
            <li><input type="submit" name="jump" value="{{ $name }}"/></li>
        @endforeach
    </ul>
</form>
