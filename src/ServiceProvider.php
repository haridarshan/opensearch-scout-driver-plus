<?php declare(strict_types=1);

namespace OpenSearch\ScoutDriverPlus;

use OpenSearch\ScoutDriver\Engine;
use OpenSearch\ScoutDriver\Factories\DocumentFactoryInterface;
use OpenSearch\ScoutDriverPlus\Engine as EnginePlus;
use OpenSearch\ScoutDriverPlus\Factories\DocumentFactory;
use OpenSearch\ScoutDriverPlus\Factories\RoutingFactory;
use OpenSearch\ScoutDriverPlus\Factories\RoutingFactoryInterface;
use OpenSearch\ScoutDriverPlus\Jobs\RemoveFromSearch;
use Illuminate\Support\ServiceProvider as AbstractServiceProvider;
use Laravel\Scout\EngineManager;
use Laravel\Scout\Jobs\RemoveFromSearch as DefaultRemoveFromSearch;
use Laravel\Scout\Scout;

final class ServiceProvider extends AbstractServiceProvider
{
    public array $bindings = [
        Engine::class => EnginePlus::class,
        DocumentFactoryInterface::class => DocumentFactory::class,
        RoutingFactoryInterface::class => RoutingFactory::class,
    ];

    /**
     * @return void
     */
    public function boot()
    {
        if (
            config('scout.driver') === 'opensearch' &&
            property_exists(Scout::class, 'removeFromSearchJob') &&
            Scout::$removeFromSearchJob === DefaultRemoveFromSearch::class
        ) {
            Scout::removeFromSearchUsing(RemoveFromSearch::class);
        }

        resolve(EngineManager::class)->extend('null', static fn () => resolve(NullEngine::class));
    }
}
