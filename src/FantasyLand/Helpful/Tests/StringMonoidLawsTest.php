<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand\Helpful\Tests;

use FunctionalPHP\FantasyLand\Helpful\MonoidLaws;
use FunctionalPHP\FantasyLand\Monoid;
use FunctionalPHP\FantasyLand\Semigroup;
use PHPUnit\Framework\TestCase;

/**
 * @template-implements Monoid<string>
 */
class StringMonoid implements Monoid
{
    private string $value;

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
 * @template-implements Monoid<string>
 */
class NotAStringMonoid implements Monoid
{
    private string $value;

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

class MonoidLawsTest extends TestCase
{
    public function test_it_should_obay_monoid_laws(): void
    {
        MonoidLaws::test(
            [$this, 'assertEquals'],
            new StringMonoid('foo'),
            new StringMonoid('bar'),
            new StringMonoid('baz')
        );
    }

    public function test_it_should_fail_monoid_laws(): void
    {
        $result = true;
        $assert = function (Monoid $a, Monoid $b) use (&$result): void {
            $result = $result && $a == $b;
        };

        MonoidLaws::test(
            $assert,
            new NotAStringMonoid('foo'),
            new NotAStringMonoid('bar'),
            new NotAStringMonoid('baz')
        );

        $this->assertFalse($result);
    }
}
