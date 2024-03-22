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
                    lineWrapping: {{ json_encode($getHasLineWrapping()) }},
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
                codeMirrorEditor.setValue({{ json_encode($getState()) }} ?? '{}');

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
