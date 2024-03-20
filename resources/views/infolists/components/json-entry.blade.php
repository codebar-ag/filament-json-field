<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">
    @php
        $identification =  $getId();
    @endphp

    <div id="{{$identification}}" class="w-full"></div>

    <script>
        var jsonData = @json($getState());

        var editor = CodeMirror(document.getElementById('{{$identification}}'), {
            value: JSON.stringify(jsonData, null, 2),
            mode: "application/json", // Set mode to JSON
            lineNumbers: true,
            readOnly: true,
            autoCloseBrackets: true,
            viewportMargin: Infinity,
            theme: 'default',
        });
        editor.setSize(null, "100%");

        editor.setValue(JSON.stringify(jsonData, null, 2));
    </script>

</x-dynamic-component>
