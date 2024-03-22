<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">
    <div
        style="position: relative; border-radius: 0.375rem;"
        x-cloak
    >
        <div
            wire:ignore
            x-init="
                codeMirrorEditor = CodeMirror($refs.input, {
                    mode: 'application/json',
                    readOnly: true,
                    lineNumbers: {{ json_encode($getHasLineNumbers()) }},
                    viewportMargin: Infinity,
                    theme: '{{ $getHasDarkTheme() ? 'darcula' : 'default' }}',
                    gutters: [
                        {{ json_encode($getHasLineNumbers()) }} ? 'CodeMirror-linenumbers' : '',
                    ],
                });

                @php
                    $state = $getState();

                    ray($state);
                @endphp

                codeMirrorEditor.setSize(null, '100%');
                codeMirrorEditor.setValue({{ json_encode(json_encode($getState(), JSON_PRETTY_PRINT), JSON_UNESCAPED_SLASHES) }} ?? '{}');

                setTimeout(function() {
                        codeMirrorEditor.refresh();
                }, 1);
            "
        >
            <div
                wire:ignore
                x-ref="input"
            ></div>
        </div>
    </div>
</x-dynamic-component>
