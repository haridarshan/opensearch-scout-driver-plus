<?php declare(strict_types=1);

namespace OpenSearch\ScoutDriverPlus\Tests\Unit\Builders;

use OpenSearch\ScoutDriverPlus\Builders\RangeQueryBuilder;
use OpenSearch\ScoutDriverPlus\Exceptions\QueryBuilderValidationException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \OpenSearch\ScoutDriverPlus\Builders\AbstractParameterizedQueryBuilder
 * @covers \OpenSearch\ScoutDriverPlus\Builders\RangeQueryBuilder
 *
 * @uses   \OpenSearch\ScoutDriverPlus\QueryParameters\ParameterCollection
 * @uses   \OpenSearch\ScoutDriverPlus\QueryParameters\Transformers\GroupedArrayTransformer
 * @uses   \OpenSearch\ScoutDriverPlus\QueryParameters\Validators\AllOfValidator
 * @uses   \OpenSearch\ScoutDriverPlus\QueryParameters\Validators\CompoundValidator
 * @uses   \OpenSearch\ScoutDriverPlus\QueryParameters\Validators\OneOfValidator
 */
final class RangeQueryBuilderTest extends TestCase
{
    private RangeQueryBuilder $builder;

    protected function setUp(): void
    {
        parent::setUp();

        $this->builder = new RangeQueryBuilder();
    }

    public function test_exception_is_thrown_when_field_is_not_specified(): void
    {
        $this->expectException(QueryBuilderValidationException::class);

        $this->builder
            ->gt(10)
            ->buildQuery();
    }

    public function test_exception_is_thrown_when_range_is_not_specified(): void
    {
        $this->expectException(QueryBuilderValidationException::class);

        $this->builder
            ->field('age')
            ->buildQuery();
    }

    public function test_query_with_field_and_gt_can_be_built(): void
    {
        $expected = [
            'range' => [
                'age' => [
                    'gt' => 10,
                ],
            ],
        ];

        $actual = $this->builder
            ->field('age')
            ->gt(10)
            ->buildQuery();

        $this->assertSame($expected, $actual);
    }

    public function test_query_with_field_and_gte_can_be_built(): void
    {
        $expected = [
            'range' => [
                'age' => [
                    'gte' => 10,
                ],
            ],
        ];

        $actual = $this->builder
            ->field('age')
            ->gte(10)
            ->buildQuery();

        $this->assertSame($expected, $actual);
    }

    public function test_query_with_field_and_lt_can_be_built(): void
    {
        $expected = [
            'range' => [
                'age' => [
                    'lt' => 20,
                ],
            ],
        ];

        $actual = $this->builder
            ->field('age')
            ->lt(20)
            ->buildQuery();

        $this->assertSame($expected, $actual);
    }

    public function test_query_with_field_and_lte_can_be_built(): void
    {
        $expected = [
            'range' => [
                'age' => [
                    'lte' => 20,
                ],
            ],
        ];

        $actual = $this->builder
            ->field('age')
            ->lte(20)
            ->buildQuery();

        $this->assertSame($expected, $actual);
    }

    public function test_query_with_field_and_gt_and_format_can_be_built(): void
    {
        $expected = [
            'range' => [
                'updated_at' => [
                    'gt' => '2020-10-18',
                    'format' => 'yyyy-MM-dd',
                ],
            ],
        ];

        $actual = $this->builder
            ->field('updated_at')
            ->gt('2020-10-18')
            ->format('yyyy-MM-dd')
            ->buildQuery();

        $this->assertSame($expected, $actual);
    }

    public function test_query_with_field_and_gt_and_lt_and_relation_can_be_built(): void
    {
        $expected = [
            'range' => [
                'age' => [
                    'gt' => 30,
                    'lt' => 60,
                    'relation' => 'INTERSECTS',
                ],
            ],
        ];

        $actual = $this->builder
            ->field('age')
            ->gt(30)
            ->lt(60)
            ->relation('INTERSECTS')
            ->buildQuery();

        $this->assertSame($expected, $actual);
    }

    public function test_query_with_field_and_gt_and_time_zone_can_be_built(): void
    {
        $expected = [
            'range' => [
                'updated_at' => [
                    'gt' => '2020-10-18',
                    'time_zone' => '+01:00',
                ],
            ],
        ];

        $actual = $this->builder
            ->field('updated_at')
            ->gt('2020-10-18')
            ->timeZone('+01:00')
            ->buildQuery();

        $this->assertSame($expected, $actual);
    }

    public function test_query_with_field_and_gt_and_boost_can_be_built(): void
    {
        $expected = [
            'range' => [
                'age' => [
                    'gt' => 40,
                    'boost' => 1.6,
                ],
            ],
        ];

        $actual = $this->builder
            ->field('age')
            ->gt(40)
            ->boost(1.6)
            ->buildQuery();

        $this->assertSame($expected, $actual);
    }
}
