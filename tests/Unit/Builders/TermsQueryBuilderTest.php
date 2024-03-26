<?php declare(strict_types=1);

namespace OpenSearch\ScoutDriverPlus\Tests\Unit\Builders;

use OpenSearch\ScoutDriverPlus\Builders\TermsQueryBuilder;
use PHPUnit\Framework\TestCase;

/**
 * @covers \OpenSearch\ScoutDriverPlus\Builders\AbstractParameterizedQueryBuilder
 * @covers \OpenSearch\ScoutDriverPlus\Builders\TermsQueryBuilder
 *
 * @uses   \OpenSearch\ScoutDriverPlus\QueryParameters\ParameterCollection
 * @uses   \OpenSearch\ScoutDriverPlus\QueryParameters\Transformers\CallbackArrayTransformer
 * @uses   \OpenSearch\ScoutDriverPlus\QueryParameters\Validators\AllOfValidator
 */
final class TermsQueryBuilderTest extends TestCase
{
    private TermsQueryBuilder $builder;

    protected function setUp(): void
    {
        parent::setUp();

        $this->builder = new TermsQueryBuilder();
    }

    public function test_query_with_terms_can_be_built(): void
    {
        $expected = [
            'terms' => [
                'programming_languages' => ['c++', 'java', 'php'],
            ],
        ];

        $actual = $this->builder
            ->field('programming_languages')
            ->values(['c++', 'java', 'php'])
            ->buildQuery();

        $this->assertSame($expected, $actual);
    }

    public function test_query_with_terms_and_boost_can_be_built(): void
    {
        $expected = [
            'terms' => [
                'programming_languages' => ['c++', 'java', 'php'],
                'boost' => 1.1,
            ],
        ];

        $actual = $this->builder
            ->field('programming_languages')
            ->values(['c++', 'java', 'php'])
            ->boost(1.1)
            ->buildQuery();

        $this->assertSame($expected, $actual);
    }
}
