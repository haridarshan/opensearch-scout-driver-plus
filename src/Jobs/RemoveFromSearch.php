<?php declare(strict_types=1);

namespace OpenSearch\ScoutDriverPlus\Jobs;

use OpenSearch\Adapter\Documents\DocumentManager;
use OpenSearch\Adapter\Documents\Routing;
use OpenSearch\ScoutDriverPlus\Factories\RoutingFactoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

final class RemoveFromSearch implements ShouldQueue
{
    use Queueable;

    public string $indexName;
    public Routing $routing;
    public array $documentIds;

    public function __construct(Collection $models)
    {
        $this->indexName = $models->first()->searchableAs();
        $this->routing = app(RoutingFactoryInterface::class)->makeFromModels($models);

        $this->documentIds = $models->map(
            static fn (Model $model) => (string)$model->getScoutKey()
        )->all();
    }

    public function handle(DocumentManager $documentManager): void
    {
        /** @var bool $refreshDocuments */
        $refreshDocuments = config('opensearch.scout_driver.refresh_documents');
        $documentManager->delete($this->indexName, $this->documentIds, $refreshDocuments, $this->routing);
    }
}
