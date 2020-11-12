<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand\Helpful\Tests;

use FunctionalPHP\FantasyLand\Functor;
use FunctionalPHP\FantasyLand\Helpful\FunctorLaws;
use FunctionalPHP\FantasyLand\Useful\Identity;
use PHPUnit\Framework\TestCase;

class FunctorLawsTest extends TestCase
{
    /**
     * @dataProvider provideFunctorTestData
     * @template T
     * @psalm-param callable(T): T $f
     * @psalm-param callable(T): T $g
     * @psalm-param Functor<T> $x
     */
    public function test_it_should_obey_functor_laws(
        callable $f,
        callable $g,
        Functor $x
    ): void {
        FunctorLaws::test(
            [$this, 'assertEquals'],
            $f,
            $g,
            $x
        );
    }

    public function provideFunctorTestData(): array
    {
        return [
            'Identity' => [
                '$f' => function (int $x) {
                    return $x + 1;
                },
                '$g' => function (int $x) {
                    return $x + 5;
                },
                '$x' => Identity::of(123),
            ],
        ];
    }
}
