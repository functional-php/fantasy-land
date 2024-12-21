<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand\Helpful;

use FunctionalPHP\FantasyLand\Setoid;
use function FunctionalPHP\FantasyLand\equal;

class SetoidLaws
{
    /**
     * @template a
     * @template b
     * @template c
     *
     * @param callable  $assertEqual
     * @param Setoid<a> $a
     * @param Setoid<b> $b
     * @param Setoid<c> $c
     */
    public static function test(
        callable $assertEqual,
        Setoid $a,
        Setoid $b,
        Setoid $c
    ): void {
        $assertEqual(
            equal($a, $a),
            true,
            'reflexivity'
        );

        $assertEqual(
            equal($a, $b),
            equal($b, $a),
            'symmetry'
        );

        $assertEqual(
            equal($a, $b) && equal($b, $c),
            equal($a, $c),
            'transitivity'
        );
    }
}
