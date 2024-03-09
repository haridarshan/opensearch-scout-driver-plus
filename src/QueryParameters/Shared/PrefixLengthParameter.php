<?php declare(strict_types=1);

namespace OpenSearch\ScoutDriverPlus\QueryParameters\Shared;

trait PrefixLengthParameter
{
    public function prefixLength(int $prefixLength): self
    {
        $this->parameters->put('prefix_length', $prefixLength);
        return $this;
    }
}
