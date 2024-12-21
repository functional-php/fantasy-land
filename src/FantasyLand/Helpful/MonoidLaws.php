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
     * @template a
     *
     * @param callable  $assertEqual Asserting function (Monoid $m1, Monoid $m2, $message)
     * @param Monoid<a> $x
     * @param Monoid<a> $y
     * @param Monoid<a> $z
     */
    public static function test(
        callable $assertEqual,
        Monoid $x,
        Monoid $y,
        Monoid $z
    ): void {
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
