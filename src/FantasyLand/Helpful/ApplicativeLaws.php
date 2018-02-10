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
     * @param callable    $assertEqual Asserting function (Applicative $a1, Applicative $a2, $message)
     * @param callable    $pure        Applicative "constructor"
     * @param Applicative $u           Applicative f => f (a -> b)
     * @param Applicative $v           Applicative f => f (a -> b)
     * @param Applicative $w           Applicative f => f (a -> b)
     * @param callable    $f           (a -> b)
     * @param mixed       $x           Value to put into a applicative
     */
    public static function test(
        callable $assertEqual,
        callable $pure,
        Applicative $u,
        Applicative $v,
        Applicative $w,
        callable $f,
        $x
    ) {
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
        $assertEqual(
            $u->ap($pure($x)),
            $pure(applicator($x))->ap($u),
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
