<?php declare(strict_types=1);

namespace OpenSearch\ScoutDriverPlus\Tests\Unit\Builders;

use OpenSearch\ScoutDriverPlus\Builders\RegexpQueryBuilder;
use OpenSearch\ScoutDriverPlus\Exceptions\QueryBuilderValidationException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \OpenSearch\ScoutDriverPlus\Builders\AbstractParameterizedQueryBuilder
 * @covers \OpenSearch\ScoutDriverPlus\Builders\RegexpQueryBuilder
 *
 * @uses   \OpenSearch\ScoutDriverPlus\QueryParameters\ParameterCollection
 * @uses   \OpenSearch\ScoutDriverPlus\QueryParameters\Transformers\GroupedArrayTransformer
 * @uses   \OpenSearch\ScoutDriverPlus\QueryParameters\Validators\AllOfValidator
 */
final class RegexpQueryBuilderTest extends TestCase
{
    private RegexpQueryBuilder $builder;

    protected function setUp(): void
    {
        parent::setUp();

        $this->builder = new RegexpQueryBuilder();
    }

    public function test_exception_is_thrown_when_field_is_not_specified(): void
    {
        $this->expectException(QueryBuilderValidationException::class);

        $this->builder
            ->value('b.*k')
            ->buildQuery();
    }

    public function test_exception_is_thrown_when_value_is_not_specified(): void
    {
        $this->expectException(QueryBuilderValidationException::class);

        $this->builder
            ->field('title')
            ->buildQuery();
    }

    public function test_query_with_field_and_value_can_be_built(): void
    {
        $expected = [
            'regexp' => [
                'title' => [
                    'value' => 'b.*k',
                ],
            ],
        ];

        $actual = $this->builder
            ->field('title')
            ->value('b.*k')
            ->buildQuery();

        $this->assertSame($expected, $actual);
    }

    public function test_query_with_field_and_value_and_flags_can_be_built(): void
    {
        $expected = [
            'regexp' => [
                'title' => [
                    'value' => 'b.*k',
                    'flags' => 'ALL',
                ],
            ],
        ];

        $actual = $this->builder
            ->field('title')
            ->value('b.*k')
            ->flags('ALL')
            ->buildQuery();

        $this->assertSame($expected, $actual);
    }

    public function test_query_with_field_and_value_and_max_determinized_states_can_be_built(): void
    {
        $expected = [
            'regexp' => [
                'title' => [
                    'value' => 'b.*k',
                    'max_determinized_states' => 10000,
                ],
            ],
        ];

        $actual = $this->builder
            ->field('title')
            ->value('b.*k')
            ->maxDeterminizedStates(10000)
            ->buildQuery();

        $this->assertSame($expected, $actual);
    }

    public function test_query_with_field_and_value_and_rewrite_can_be_built(): void
    {
        $expected = [
            'regexp' => [
                'title' => [
                    'value' => 'b.*k',
                    'rewrite' => 'constant_score',
                ],
            ],
        ];

        $actual = $this->builder
            ->field('title')
            ->value('b.*k')
            ->rewrite('constant_score')
            ->buildQuery();

        $this->assertSame($expected, $actual);
    }

    public function test_query_with_field_and_value_and_case_insensitive_can_be_built(): void
    {
        $expected = [
            'regexp' => [
                'title' => [
                    'value' => 'b.*k',
                    'case_insensitive' => true,
                ],
            ],
        ];

        $actual = $this->builder
            ->field('title')
            ->value('b.*k')
            ->caseInsensitive(true)
            ->buildQuery();

        $this->assertSame($expected, $actual);
    }
}
