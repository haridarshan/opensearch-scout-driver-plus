<?php declare(strict_types=1);

namespace OpenSearch\ScoutDriverPlus\Tests\Unit\Builders;

use OpenSearch\ScoutDriverPlus\Builders\MatchAllQueryBuilder;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * @covers \OpenSearch\ScoutDriverPlus\Builders\MatchAllQueryBuilder
 */
final class MatchAllQueryBuilderTest extends TestCase
{
    private MatchAllQueryBuilder $builder;

    protected function setUp(): void
    {
        parent::setUp();

        $this->builder = new MatchAllQueryBuilder();
    }

    public function test_query_can_be_built(): void
    {
        $expected = ['match_all' => new stdClass()];
        $actual = $this->builder->buildQuery();

        $this->assertEquals($expected, $actual);
    }
}
