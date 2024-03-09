<?php declare(strict_types=1);

namespace OpenSearch\ScoutDriverPlus\Factories;

use OpenSearch\Adapter\Documents\Routing;
use Illuminate\Support\Collection;

interface RoutingFactoryInterface
{
    public function makeFromModels(Collection $models): Routing;
}
