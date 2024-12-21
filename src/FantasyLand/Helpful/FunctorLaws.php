<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand\Helpful;

use FunctionalPHP\FantasyLand\Functor;
use function FunctionalPHP\FantasyLand\compose;
use function FunctionalPHP\FantasyLand\map;

class FunctorLaws
{
    /**
     * Generic test to verify if a type obey the functor laws.
     *
     * @template a
     * @template b
     * @template c
     *
     * @param callable       $assertEqual Asserting function (Functor $f1, Functor $f2, $message)
     * @param callable(b): c $f           (a -> b)
     * @param callable(a): b $g           (a -> b)
     * @param Functor<a>     $x           f a
     */
    public static function test(
        callable $assertEqual,
        callable $f,
        callable $g,
        Functor $x
    ): void {
        $identity =
            /**
             * @param  a $x
             * @return a
             */
            static function ($x) {
                return $x;
            };

        // identity: fmap id  ==  id
        $assertEqual(
            map($identity, $x),
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
