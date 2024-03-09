<?php declare(strict_types=1);

namespace OpenSearch\ScoutDriverPlus\QueryParameters\Shared;

trait FlagsParameter
{
    public function flags(string $flags): self
    {
        $this->parameters->put('flags', $flags);
        return $this;
    }
}
