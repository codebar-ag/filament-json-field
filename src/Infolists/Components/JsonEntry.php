<?php

namespace CodebarAg\FilamentCodemirror\Infolists\Components;

use Closure;
use Filament\Infolists\Components\Entry;

class JsonEntry extends Entry
{
    protected string $view = 'filament-codemirror::infolists.components.json-entry';

    protected bool|Closure $hasLineNumbers = true;

    protected bool|Closure $hasAutoCloseBrackets = true;

    protected bool|Closure $hasDarkTheme = false;

    protected bool|Closure $hasFoldingCode = true;

    public function lineNumbers(bool|Closure $condition = true): static
    {
        $this->hasLineNumbers = $condition;

        return $this;
    }

    public function autoCloseBrackets(bool|Closure $condition = true): static
    {
        $this->hasAutoCloseBrackets = $condition;

        return $this;
    }

    public function darkTheme(bool|Closure $condition = true): static
    {
        $this->hasDarkTheme = $condition;

        return $this;
    }

    public function foldingCode(bool|Closure $condition = true): static
    {
        $this->hasFoldingCode = $condition;

        return $this;
    }

    public function getHasLineNumbers(): bool
    {
        return (bool) $this->evaluate($this->hasLineNumbers);
    }

    public function getHasAutoCloseBrackets(): bool
    {
        return (bool) $this->evaluate($this->hasAutoCloseBrackets);
    }

    public function getHasDarkTheme(): bool
    {
        return (bool) $this->evaluate($this->hasDarkTheme);
    }

    public function getHasFoldingCode(): bool
    {
        return (bool) $this->evaluate($this->hasFoldingCode);
    }
}
