<?php

namespace CodebarAg\FilamentJsonField\Concerns;

use Closure;

trait HasLineNumbers
{
    protected bool|Closure $hasLineNumbers = true;

    public function lineNumbers(bool|Closure $condition = true): static
    {
        $this->hasLineNumbers = $condition;

        return $this;
    }

    public function getHasLineNumbers(): bool
    {
        return (bool) $this->evaluate($this->hasLineNumbers);
    }
}
