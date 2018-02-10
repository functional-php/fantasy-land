<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand\Helpful;

use FunctionalPHP\FantasyLand\Monoid;
use function FunctionalPHP\FantasyLand\concat;
use function FunctionalPHP\FantasyLand\emptyy;

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
            concat($x, emptyy($x)),
            $x,
            'Right identity'
        );

        $assertEqual(
            concat(emptyy($x), $x),
            $x,
            'Left identity'
        );

        $assertEqual(
            concat($x, concat($y, $z)),
            concat(concat($x, $y), $z),
            'Associativity'
        );
    }
}
