<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand\Helpful;

use function FunctionalPHP\FantasyLand\bind;

class MonadLaws
{
    /**
     * Generic test to verify if a type obey the monad laws.
     *
     * @template X
     * @psalm-param callable(X): \FunctionalPHP\FantasyLand\Monad<X> $return
     * @psalm-param callable(X): \FunctionalPHP\FantasyLand\Monad<X> $f
     * @psalm-param callable(X): \FunctionalPHP\FantasyLand\Monad<X> $g
     * @psalm-param X $x
     *
     * @param callable $assertEqual Asserting function (Monad $m1, Monad $m2, $message)
     * @param callable $return      Monad "constructor"
     * @param callable $f           Monadic function
     * @param callable $g           Monadic function
     * @param mixed    $x           Value to put into a monad
     */
    public static function test(
        callable $assertEqual,
        callable $return,
        callable $f,
        callable $g,
        $x
    ): void {
        // Make reading bellow tests easier
        $m = $return($x);

        // left identity: (return x) >>= f ≡ f x
        $assertEqual(bind($f, $return($x)), $f($x), 'left identity');

        // right identity: m >>= return ≡ m
        $assertEqual(bind($return, $m), $m, 'right identity');

        // associativity: (m >>= f) >>= g ≡ m >>= ( \x -> (f x >>= g) )
        $assertEqual(
            bind($g, bind($f, $m)),
            bind(
                /** @psalm-param X $x */
                function ($x) use ($g, $f) {
                    return bind($g, $f($x));
                },
                $m
            ),
            'associativity'
        );
    }
}
