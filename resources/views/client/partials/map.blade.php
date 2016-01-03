<script>
    var elements = {!! json_encode($data->starMap) !!}
</script>
<h2>Star map</h2>
<pre>
{{ var_export($data->starMap, true) }}
</pre>
