<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand\Helpful\Tests;

use Eris\Generator;
use Eris\TestTrait;
use FunctionalPHP\FantasyLand\Helpful\SetoidLaws;
use FunctionalPHP\FantasyLand\Setoid;

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

class StringSetoidLawsTest extends \PHPUnit_Framework_TestCase
{
    use TestTrait;

    public function test_it_should_obay_setoid_laws()
    {
        $this->forAll(
            Generator\char(),
            Generator\string(),
            Generator\names()
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
