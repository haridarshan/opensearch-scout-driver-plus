<?php declare(strict_types=1);

namespace OpenSearch\ScoutDriverPlus\QueryParameters\Shared;

trait BoostParameter
{
    public function boost(float $boost): self
    {
        $this->parameters->put('boost', $boost);
        return $this;
    }
}
