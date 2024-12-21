<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand\Helpful;

use FunctionalPHP\FantasyLand\Monad;

use function FunctionalPHP\FantasyLand\bind;

class MonadLaws
{
    /**
     * Generic test to verify if a type obey the monad laws.
     *
     * @template a
     * @template b
     * @template c
     *
     * @param callable              $assertEqual Asserting function (Monad $m1, Monad $m2, $message)
     * @param a                     $x           Value to put into a monad
     * @param callable(a): Monad<a> $return      Monad "constructor"
     * @param callable(a): Monad<b> $f           Monadic function
     * @param callable(b): Monad<c> $g           Monadic function
     */
    public static function test(
        callable $assertEqual,
        $x,
        callable $return,
        callable $f,
        callable $g
    ): void {
        // Make reading bellow tests easier
        $m = $return($x);

        // left identity: (return x) >>= f ≡ f x
        $assertEqual(
            bind($f, $return($x)),
            $f($x),
            'left identity'
        );

        // right identity: m >>= return ≡ m
        $assertEqual(bind($return, $m), $m, 'right identity');

        // associativity: (m >>= f) >>= g ≡ m >>= ( \x -> (f x >>= g) )

        /** @var Monad<b> $boundF */
        $boundF = bind($f, $m);
        /** @var Monad<c> $boundG */
        $boundG = bind($g, $boundF);
        $boundFoG =
            /**
             * @param  a        $x
             * @return Monad<c>
             */
            function ($x) use ($f, $g) {
                /** @var Monad<c> */
                return bind($g, $f($x));
            };

        $assertEqual(
            $boundG,
            bind($boundFoG, $m),
            'associativity'
        );
    }
}
