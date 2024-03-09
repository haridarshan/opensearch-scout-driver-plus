<?php declare(strict_types=1);

namespace OpenSearch\ScoutDriverPlus\QueryParameters\Validators;

use OpenSearch\ScoutDriverPlus\QueryParameters\ParameterCollection;

final class CompoundValidator implements ValidatorInterface
{
    private array $validators;

    public function __construct(ValidatorInterface ...$validators)
    {
        $this->validators = $validators;
    }

    public function validate(ParameterCollection $parameters): void
    {
        foreach ($this->validators as $validator) {
            $validator->validate($parameters);
        }
    }
}
