<?php declare(strict_types=1);

namespace OpenSearch\ScoutDriverPlus\QueryParameters\Shared;

trait AnalyzerParameter
{
    public function analyzer(string $analyzer): self
    {
        $this->parameters->put('analyzer', $analyzer);
        return $this;
    }
}
