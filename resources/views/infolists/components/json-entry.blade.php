<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">
    <div
        style="position: relative; border-radius: 0.375rem; overflow-x: scroll;"
        x-cloak
    >
        <div
            wire:ignore
            x-init="
                {{ str_replace('.', '', $getId()) }} = CodeMirror($refs.{{ str_replace('.', '', $getId()) }}, {
                    mode: 'application/json',
                    readOnly: true,
                    lineNumbers: {{ json_encode($getHasLineNumbers()) }},
                    lineWrapping: {{ json_encode($getHasLineWrapping()) }},
                    autoCloseBrackets: {{ json_encode($getHasAutoCloseBrackets()) }},
                    lineNumbers: {{ json_encode($getHasLineNumbers()) }},
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
                            var prevLine = {{ str_replace('.', '', $getId()) }}.getLine(from.line);
                            if (prevLine.lastIndexOf('[') > prevLine.lastIndexOf('{')) {
                                startToken = '[', endToken = ']';
                            }

                            // Get json content
                            var internal = {{ str_replace('.', '', $getId()) }}.getRange(from, to);
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

                {{ str_replace('.', '', $getId()) }}.setSize(null, '100%');
                {{ str_replace('.', '', $getId()) }}.setValue({{ json_encode(json_encode($getState(), JSON_PRETTY_PRINT), JSON_UNESCAPED_SLASHES) }} ?? '{}');

                setTimeout(function() {
                        {{ str_replace('.', '', $getId()) }}.refresh();
                }, 1);
            "
        >
            <div
                wire:ignore
                x-ref="{{ str_replace('.', '', $getId()) }}"
            ></div>
        </div>
    </div>
</x-dynamic-component>
