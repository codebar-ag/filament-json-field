<?php

namespace CodebarAg\FilamentJsonField\Concerns;

use Closure;

trait HasDarkTheme
{
    protected bool|Closure $hasDarkTheme = false;

    public function darkTheme(bool|Closure $condition = true): static
    {
        $this->hasDarkTheme = $condition;

        return $this;
    }

    public function getHasDarkTheme(): bool
    {
        return (bool) $this->evaluate($this->hasDarkTheme);
    }
}
