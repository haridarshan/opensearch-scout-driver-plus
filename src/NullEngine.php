<?php declare(strict_types=1);

namespace OpenSearch\ScoutDriverPlus;

use OpenSearch\Adapter\Documents\DocumentManager;
use OpenSearch\Adapter\Indices\IndexManager;
use OpenSearch\Adapter\Search\PointInTimeManager;
use OpenSearch\Adapter\Search\SearchParameters;
use OpenSearch\Adapter\Search\SearchResult as BaseSearchResult;
use OpenSearch\ScoutDriver\Factories\DocumentFactoryInterface;
use OpenSearch\ScoutDriver\Factories\ModelFactoryInterface;
use OpenSearch\ScoutDriver\Factories\SearchParametersFactoryInterface;
use OpenSearch\ScoutDriverPlus\Factories\RoutingFactoryInterface;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\LazyCollection;
use Laravel\Scout\Builder;

final class NullEngine extends Engine
{
    private BaseSearchResult $emptySearchResult;

    public function __construct(
        DocumentManager $documentManager,
        IndexManager $indexManager,
        PointInTimeManager $pointInTimeManager,
        DocumentFactoryInterface $documentFactory,
        SearchParametersFactoryInterface $searchParametersFactory,
        ModelFactoryInterface $modelFactory,
        RoutingFactoryInterface $routingFactory
    ) {
        parent::__construct(
            $documentManager,
            $indexManager,
            $pointInTimeManager,
            $documentFactory,
            $searchParametersFactory,
            $modelFactory,
            $routingFactory
        );

        $this->emptySearchResult = new BaseSearchResult([
            'hits' => [
                'total' => ['value' => 0],
                'hits' => [],
            ],
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function update($models)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function delete($models)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function search(Builder $builder)
    {
        return $this->emptySearchResult;
    }

    /**
     * {@inheritDoc}
     */
    public function paginate(Builder $builder, $perPage, $page)
    {
        return $this->emptySearchResult;
    }

    /**
     * {@inheritDoc}
     */
    public function map(Builder $builder, $results, $model)
    {
        return EloquentCollection::make();
    }

    /**
     * {@inheritDoc}
     */
    public function lazyMap(Builder $builder, $results, $model)
    {
        return LazyCollection::make();
    }

    /**
     * {@inheritDoc}
     */
    public function flush($model)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function createIndex($name, array $options = [])
    {
    }

    /**
     * {@inheritDoc}
     */
    public function deleteIndex($name)
    {
    }

    public function searchWithParameters(SearchParameters $searchParameters): BaseSearchResult
    {
        return $this->emptySearchResult;
    }

    public function connection(string $connection): self
    {
        return $this;
    }

    public function openPointInTime(string $indexName, ?string $keepAlive = null): string
    {
        return '';
    }

    public function closePointInTime(string $pointInTimeId): void
    {
    }
}
