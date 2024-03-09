<?php declare(strict_types=1);

namespace OpenSearch\ScoutDriverPlus\QueryParameters\Shared;

trait SlopParameter
{
    public function slop(int $slop): self
    {
        $this->parameters->put('slop', $slop);
        return $this;
    }
}
