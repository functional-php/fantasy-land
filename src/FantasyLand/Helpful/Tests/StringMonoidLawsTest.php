<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand\Helpful\Tests;

use Eris\Generator;
use Eris\TestTrait;
use FunctionalPHP\FantasyLand\Helpful\MonoidLaws;
use FunctionalPHP\FantasyLand\Monoid;
use FunctionalPHP\FantasyLand\Semigroup;
use function FunctionalPHP\FantasyLand\concat;
use function FunctionalPHP\FantasyLand\emptyy;

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

/**
 * This class is not a monoid because it does not obey the monoid laws,
 * despite implementing the Monoid interface. In particular, it does not obay
 * the right identity and left identity laws, due to the way the `mempty` method
 * is implemented.
 *
 * @implements Monoid<string>
 */
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

class StringMonoidLawsTest extends \PHPUnit\Framework\TestCase
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
            $x = new NotAStringMonoid($a);
            $y = new NotAStringMonoid($b);
            $z = new NotAStringMonoid($c);

            $this->assertNotEquals(
                concat($x, emptyy($x)),
                $x,
                'Right identity'
            );

            $this->assertNotEquals(
                concat(emptyy($x), $x),
                $x,
                'Left identity'
            );

            $this->assertEquals(
                concat($x, concat($y, $z)),
                concat(concat($x, $y), $z),
                'Associativity'
            );
        });
    }
}
