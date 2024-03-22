<?php

namespace CodebarAg\FilamentJsonField\Concerns;

use Closure;

trait HasLineWrapping
{
    protected bool|Closure $hasLineWrapping = true;

    public function lineWrapping(bool|Closure $condition = true): static
    {
        $this->hasLineWrapping = $condition;

        return $this;
    }

    public function getHasLineWrapping(): bool
    {
        return (bool) $this->evaluate($this->hasLineWrapping);
    }
}
