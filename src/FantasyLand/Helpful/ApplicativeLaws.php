<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand\Helpful;

use FunctionalPHP\FantasyLand\Applicative;
use const FunctionalPHP\FantasyLand\compose;
use const FunctionalPHP\FantasyLand\identity;
use function FunctionalPHP\FantasyLand\applicator;
use function FunctionalPHP\FantasyLand\curryN;

class ApplicativeLaws
{
    /**
     * Generic test to verify if a type obey the applicative laws.
     *
     * @template a
     * @template b
     * @template c
     * @template d
     *
     * @param callable                            $assertEqual Asserting function (Applicative $a1, Applicative $a2, $message)
     * @param a                                   $x           Value to put into a applicative
     * @param callable(mixed): Applicative<mixed> $pure        Applicative "constructor"
     * @param Applicative<callable(a): b>         $u           Applicative f => f (a -> b)
     * @param Applicative<callable(b): c>         $v           Applicative f => f (a -> b)
     * @param Applicative<callable(c): d>         $w           Applicative f => f (a -> b)
     * @param callable(a): b                      $f           (a -> b)
     */
    public static function test(
        callable $assertEqual,
        $x,
        callable $pure,
        Applicative $u,
        Applicative $v,
        Applicative $w,
        callable $f
    ): void {
        // identity: pure id <*> v = v
        $assertEqual(
            $pure(identity)->ap($v),
            $v,
            'identity'
        );

        // homomorphism: pure f <*> pure x = pure (f x)
        $assertEqual(
            $pure($f)->ap($pure($x)),
            $pure($f($x)),
            'homomorphism'
        );

        // interchange: u <*> pure x = pure ($ x) <*> u
        /** @var callable(callable(a): b): b $ap */
        $applicatorX = applicator($x);
        $assertEqual(
            $u->ap($pure($x)),
            $pure($applicatorX)->ap($u),
            'interchange'
        );

        // composition: pure (.) <*> u <*> v <*> w = u <*> (v <*> w)
        $compose = curryN(2, compose);
        $assertEqual(
            $pure($compose)->ap($u)->ap($v)->ap($w),
            $u->ap($v->ap($w)),
            'composition'
        );
    }
}
