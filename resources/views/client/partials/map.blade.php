<script>
    var elements = {!! json_encode($starMap) !!}
</script>
<h2>Star map</h2>
<pre>
{{ var_export($starMap, true) }}
</pre>
