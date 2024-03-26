<?php

namespace CodebarAg\FilamentJsonField\Concerns;

use Closure;

trait HasFoldingCode
{
    protected bool|Closure $hasFoldingCode = true;
    protected bool|Closure $hasFoldedCode = false;

    public function foldingCode(bool|Closure $condition = true): static
    {
        $this->hasFoldingCode = $condition;

        return $this;
    }

    public function getHasFoldingCode(): bool
    {
        return (bool) $this->evaluate($this->hasFoldingCode);
    }

    public function foldedCode(bool|Closure $condition = true): static
    {
        $this->hasFoldingCode = $condition;
        $this->hasFoldedCode = $condition;

        return $this;
    }

    public function getHasFoldedCode(): bool
    {
        return (bool) $this->evaluate($this->hasFoldedCode);
    }
}
