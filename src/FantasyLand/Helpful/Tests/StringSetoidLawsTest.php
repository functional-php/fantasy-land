<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand\Helpful\Tests;

use Eris\Generators;
use Eris\TestTrait;
use FunctionalPHP\FantasyLand\Helpful\SetoidLaws;
use FunctionalPHP\FantasyLand\Setoid;

/**
 * @implements Setoid<string>
 */
class StringSetoid implements Setoid
{
    /**
     * @var string
     */
    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @inheritdoc
     */
    public function equals($other): bool
    {
        return $other instanceof StringSetoid
            ? $other->value === $this->value
            : false;
    }
}

class StringSetoidLawsTest extends \PHPUnit\Framework\TestCase
{
    use TestTrait;

    public function test_it_should_obay_setoid_laws(): void
    {
        $this->forAll(
            Generators::char(),
            Generators::string(),
            Generators::names()
        )->then(function (string $a, string $b, string $c) {
            SetoidLaws::test(
                [$this, 'assertEquals'],
                new StringSetoid($a),
                new StringSetoid($b),
                new StringSetoid($c)
            );
        });
    }
}
