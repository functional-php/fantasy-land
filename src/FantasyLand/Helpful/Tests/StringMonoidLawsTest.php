<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand\Helpful\Tests;

use Eris\Generator;
use Eris\TestTrait;
use FunctionalPHP\FantasyLand\Helpful\MonoidLaws;
use FunctionalPHP\FantasyLand\Monoid;
use FunctionalPHP\FantasyLand\Semigroup;

class StringMonoid implements Monoid
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
    public static function mempty()
    {
        return new self("");
    }

    /**
     * @inheritdoc
     */
    public function concat(Semigroup $value): Semigroup
    {
        return new self($this->value . $value->value);
    }
}

class NotAStringMonoid implements Monoid
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
    public static function mempty()
    {
        return new self("-");
    }

    /**
     * @inheritdoc
     */
    public function concat(Semigroup $value): Semigroup
    {
        return new self($this->value . ":" . $value->value);
    }
}

class MonoidLawsTest extends \PHPUnit_Framework_TestCase
{
    use TestTrait;

    public function test_it_should_obay_monoid_laws()
    {
        $this->forAll(
            Generator\char(),
            Generator\string(),
            Generator\names()
        )->then(function (string $a, string $b, string $c) {
            MonoidLaws::test(
                [$this, 'assertEquals'],
                new StringMonoid($a),
                new StringMonoid($b),
                new StringMonoid($c)
            );
        });
    }

    /**
     * @expectedException \DomainException
     */
    public function test_it_should_fail_monoid_laws()
    {
        $this->forAll(
            Generator\char(),
            Generator\string(),
            Generator\names()
        )->then(function (string $a, string $b, string $c) {
            MonoidLaws::test(
                [$this, 'assertEquals'],
                new NotAStringMonoid($a),
                new NotAStringMonoid($b),
                new NotAStringMonoid($c)
            );
        });
    }
}
