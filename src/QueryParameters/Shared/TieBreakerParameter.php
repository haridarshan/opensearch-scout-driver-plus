<?php declare(strict_types=1);

namespace OpenSearch\ScoutDriverPlus\QueryParameters\Shared;

trait TieBreakerParameter
{
    public function tieBreaker(float $tieBreaker): self
    {
        $this->parameters->put('tie_breaker', $tieBreaker);
        return $this;
    }
}
