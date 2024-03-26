<?php declare(strict_types=1);

namespace OpenSearch\ScoutDriverPlus\Tests\Unit\Builders;

use OpenSearch\ScoutDriverPlus\Builders\ExistsQueryBuilder;
use OpenSearch\ScoutDriverPlus\Exceptions\QueryBuilderValidationException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \OpenSearch\ScoutDriverPlus\Builders\AbstractParameterizedQueryBuilder
 * @covers \OpenSearch\ScoutDriverPlus\Builders\ExistsQueryBuilder
 *
 * @uses   \OpenSearch\ScoutDriverPlus\QueryParameters\ParameterCollection
 * @uses   \OpenSearch\ScoutDriverPlus\QueryParameters\Transformers\FlatArrayTransformer
 * @uses   \OpenSearch\ScoutDriverPlus\QueryParameters\Validators\AllOfValidator
 */
final class ExistsQueryBuilderTest extends TestCase
{
    private ExistsQueryBuilder $builder;

    protected function setUp(): void
    {
        parent::setUp();

        $this->builder = new ExistsQueryBuilder();
    }

    public function test_exception_is_thrown_when_field_is_not_specified(): void
    {
        $this->expectException(QueryBuilderValidationException::class);

        $this->builder
            ->buildQuery();
    }

    public function test_query_with_field_can_be_built(): void
    {
        $expected = [
            'exists' => [
                'field' => 'message',
            ],
        ];

        $actual = $this->builder
            ->field('message')
            ->buildQuery();

        $this->assertSame($expected, $actual);
    }
}
