<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand\Helpful;

use FunctionalPHP\FantasyLand\Monoid;

class MonoidLaws
{
    /**
     * Generic test to verify if a type obey the monodic laws.
     *
     * @param callable $assertEqual Asserting function (Monoid $m1, Monoid $m2, $message)
     * @param Monoid   $x
     * @param Monoid   $y
     * @param Monoid   $z
     */
    public static function test(
        callable $assertEqual,
        Monoid $x,
        Monoid $y,
        Monoid $z
    ) {
        $assertEqual(
            $x->concat($x::mempty()),
            $x,
            'Right identity'
        );

        $assertEqual(
            $x::mempty()->concat($x),
            $x,
            'Left identity'
        );

        $assertEqual(
            $x->concat($y->concat($z)),
            $x->concat($y)->concat($z),
            'Associativity'
        );
    }
}
