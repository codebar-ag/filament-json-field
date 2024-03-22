<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div
        x-data="{ state: $wire.{{ $applyStateBindingModifiers("\$entangle('{$getStatePath()}')") }} }"
        class="relative rounded-md"
        x-cloak
    >
        <div
            wire:ignore
            x-init="
                codeMirrorEditor = CodeMirror($refs.input, {
                    mode: 'application/json',
                    lineNumbers: {{ json_encode($getHasLineNumbers()) }},
                    autoCloseBrackets: {{ json_encode($getHasAutoCloseBrackets()) }},
                    viewportMargin: Infinity,
                    theme: '{{ $getHasDarkTheme() ? 'darcula' : 'default' }}',
                    foldGutter: {{ json_encode($getHasFoldingCode()) }},
                    @php
                        if($getHasFoldingCode()) {
                            echo "extraKeys: {'Ctrl-Q': function(cm) { cm.foldCode(cm.getCursor()); }},";
                        }
                    @endphp
                    gutters: [
                        {{ json_encode($getHasLineNumbers()) }} ? 'CodeMirror-linenumbers' : '',
                        {{ json_encode($getHasFoldingCode()) }} ? 'CodeMirror-foldgutter' : '',
                    ],
                    foldOptions: {
                        widget: (from, to) => {
                            var count = undefined;

                            // Get open / close token
                            var startToken = '{', endToken = '}';
                            var prevLine = codeMirrorEditor.getLine(from.line);
                            if (prevLine.lastIndexOf('[') > prevLine.lastIndexOf('{')) {
                                startToken = '[', endToken = ']';
                            }

                            // Get json content
                            var internal = codeMirrorEditor.getRange(from, to);
                            var toParse = startToken + internal + endToken;

                            // Get key count
                            try {
                                var parsed = JSON.parse(toParse);
                                count = Object.keys(parsed).length;
                            } catch(e) { }

                            return count ? `\u21A4${count}\u21A6` : '\u2194';
                        }
                    }
                });

                codeMirrorEditor.setSize(null, '100%');
                codeMirrorEditor.setValue(state);

                setTimeout(function() {
                        codeMirrorEditor.refresh();
                }, 1);

                codeMirrorEditor.on('change', () => state = codeMirrorEditor.getValue())
            "
        >
            <div
                wire:ignore
                x-ref="input"
                class="w-full"
            ></div>
        </div>
    </div>
</x-dynamic-component>
