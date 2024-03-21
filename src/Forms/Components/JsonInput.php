<?php

namespace CodebarAg\FilamentJsonField\Forms\Components;

use CodebarAg\FilamentJsonField\Concerns\HasAutoCloseBrackets;
use CodebarAg\FilamentJsonField\Concerns\HasDarkTheme;
use CodebarAg\FilamentJsonField\Concerns\HasFoldingCode;
use CodebarAg\FilamentJsonField\Concerns\HasLineNumbers;
use Filament\Forms\Components\Concerns;
use Filament\Forms\Components\Field;

class JsonInput extends Field
{
    use Concerns\CanBeReadOnly;
    use HasAutoCloseBrackets;
    use HasDarkTheme;
    use HasFoldingCode;
    use HasLineNumbers;

    protected string $view = 'filament-json-field::forms.components.json-input';
}
