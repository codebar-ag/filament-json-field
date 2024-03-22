<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"

>
    <div
        x-data="{ state: $wire.{{ $applyStateBindingModifiers("\$entangle('{$getStatePath()}')") }} }"
        style="position: relative; border-radius: 0.375rem; overflow-x: scroll;"
        x-cloak
    >
        <div
            wire:ignore
            x-init="
                {{ str_replace('.', '', $getId()) }} = CodeMirror($refs.{{ str_replace('.', '', $getId()) }}, {
                    mode: 'application/json',
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

                {{ str_replace('.', '', $getId()) }}.setSize('100%', '100%');
                {{ str_replace('.', '', $getId()) }}.setValue({{ json_encode(json_encode($getState(), JSON_PRETTY_PRINT), JSON_UNESCAPED_SLASHES) }} ?? '{}');

                setTimeout(function() {
                        {{ str_replace('.', '', $getId()) }}.refresh();
                }, 1);

                {{ str_replace('.', '', $getId()) }}.on('change', function () {
                    try {
                        state = JSON.parse({{ str_replace('.', '', $getId()) }}.getValue())
                    } catch (e) {
                        state = {{ str_replace('.', '', $getId()) }}.getValue();
                    }
                });
            "
        >
            <div
                wire:ignore
                x-ref="{{ str_replace('.', '', $getId()) }}"
            ></div>
        </div>
    </div>
</x-dynamic-component>
