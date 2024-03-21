<?php

namespace CodebarAg\FilamentJsonField\Concerns;

use Closure;

trait HasAutoCloseBrackets
{
    protected bool|Closure $hasAutoCloseBrackets = true;

    public function autoCloseBrackets(bool|Closure $condition = true): static
    {
        $this->hasAutoCloseBrackets = $condition;

        return $this;
    }

    public function getHasAutoCloseBrackets(): bool
    {
        return (bool) $this->evaluate($this->hasAutoCloseBrackets);
    }
}
