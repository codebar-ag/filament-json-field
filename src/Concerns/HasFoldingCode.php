<?php

namespace CodebarAg\FilamentJsonField\Concerns;

use Closure;

trait HasFoldingCode
{
    protected bool|Closure $hasFoldingCode = true;

    public function foldingCode(bool|Closure $condition = true): static
    {
        $this->hasFoldingCode = $condition;

        return $this;
    }

    public function getHasFoldingCode(): bool
    {
        return (bool) $this->evaluate($this->hasFoldingCode);
    }
}
