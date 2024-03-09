<?php declare(strict_types=1);

namespace OpenSearch\ScoutDriverPlus\QueryParameters\Shared;

trait ValidationMethodParameter
{
    public function validationMethod(string $validationMethod): self
    {
        $this->parameters->put('validation_method', $validationMethod);
        return $this;
    }
}
