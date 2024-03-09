<?php declare(strict_types=1);

namespace OpenSearch\ScoutDriverPlus\QueryParameters\Shared;

trait FieldParameter
{
    public function field(string $field): self
    {
        $this->parameters->put('field', $field);
        return $this;
    }
}
