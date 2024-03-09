<?php declare(strict_types=1);

namespace OpenSearch\ScoutDriverPlus\QueryParameters\Transformers;

use OpenSearch\ScoutDriverPlus\QueryParameters\ParameterCollection;

final class GroupedArrayTransformer implements ArrayTransformerInterface
{
    private string $groupKey;

    public function __construct(string $groupKey)
    {
        $this->groupKey = $groupKey;
    }

    public function transform(ParameterCollection $parameters): array
    {
        return [
            $parameters->get($this->groupKey) => $parameters->except($this->groupKey)->excludeEmpty()->toArray(),
        ];
    }
}
