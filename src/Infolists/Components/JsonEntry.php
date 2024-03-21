<?php

namespace CodebarAg\FilamentJsonField\Infolists\Components;

use CodebarAg\FilamentJsonField\Concerns\HasAutoCloseBrackets;
use CodebarAg\FilamentJsonField\Concerns\HasDarkTheme;
use CodebarAg\FilamentJsonField\Concerns\HasFoldingCode;
use CodebarAg\FilamentJsonField\Concerns\HasLineNumbers;
use Filament\Infolists\Components\Entry;

class JsonEntry extends Entry
{
    use HasAutoCloseBrackets;
    use HasDarkTheme;
    use HasFoldingCode;
    use HasLineNumbers;

    protected string $view = 'filament-json-field::infolists.components.json-entry';
}
