<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand\Helpful\Tests;

use FunctionalPHP\FantasyLand\Helpful\SetoidLaws;
use FunctionalPHP\FantasyLand\Setoid;
use PHPUnit\Framework\TestCase;

class StringSetoid implements Setoid
{
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

class StringSetoidLawsTest extends TestCase
{
    public function test_it_should_obay_setoid_laws(): void
    {
        SetoidLaws::test(
            [$this, 'assertEquals'],
            new StringSetoid('foo'),
            new StringSetoid('bar'),
            new StringSetoid('baz')
        );
    }
}
