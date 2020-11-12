<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand\Helpful;

use FunctionalPHP\FantasyLand\Functor;
use const FunctionalPHP\FantasyLand\identity;
use function FunctionalPHP\FantasyLand\compose;
use function FunctionalPHP\FantasyLand\map;

class FunctorLaws
{
    /**
     * Generic test to verify if a type obey the functor laws.
     *
     * @template T
     * @psalm-param callable(T): T $f
     * @psalm-param callable(T): T $g
     * @psalm-param Functor<T> $x
     *
     * @param callable $assertEqual Asserting function (Functor $f1, Functor $f2, $message)
     * @param callable $f           (a -> b)
     * @param callable $g           (a -> b)
     * @param Functor  $x           f a
     */
    public static function test(
        callable $assertEqual,
        callable $f,
        callable $g,
        Functor $x
    ): void {
        // identity: fmap id  ==  id
        $assertEqual(
            map(identity, $x),
            $x,
            'identity'
        );

        // composition: fmap (f . g)  ==  fmap f . fmap g
        $assertEqual(
            map(compose($f, $g), $x),
            compose(map($f), map($g))($x),
            'composition'
        );
    }
}
