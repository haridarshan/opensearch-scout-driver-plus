<?php declare(strict_types=1);

namespace OpenSearch\ScoutDriverPlus\QueryParameters\Shared;

trait ZeroTermsQueryParameter
{
    public function zeroTermsQuery(string $zeroTermsQuery): self
    {
        $this->parameters->put('zero_terms_query', $zeroTermsQuery);
        return $this;
    }
}
