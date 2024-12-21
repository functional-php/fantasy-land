<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand\Helpful\Tests;

use FunctionalPHP\FantasyLand\Functor;
use FunctionalPHP\FantasyLand\Helpful\FunctorLaws;
use FunctionalPHP\FantasyLand\Useful\Identity;

class FunctorLawsTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider provideFunctorTestData
     *
     * @template a
     * @template b
     * @template c
     *
     * @param callable(b): c $f
     * @param callable(a): b $g
     * @param Functor<a>     $x
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

    /**
     * @return array{Identity: array<string, mixed>}
     */
    public static function provideFunctorTestData(): array
    {
        return [
            'Identity' => [
                'f' => function (int $x) {
                    return $x + 1;
                },
                'g' => function (int $x) {
                    return $x + 5;
                },
                'x' => Identity::of(123),
            ],
        ];
    }
}
