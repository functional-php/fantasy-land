<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand\Helpful\Tests;

use FunctionalPHP\FantasyLand\Helpful\MonadLaws;
use FunctionalPHP\FantasyLand\Useful\Identity;

class MonadLawsTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider provideData
     *
     * @template a
     * @template b
     * @template c
     *
     * @param a                        $x
     * @param callable(a): Identity<b> $f
     * @param callable(b): Identity<c> $g
     */
    public function test_if_identity_monad_obeys_the_laws($x, $f, $g): void
    {
        // This is a workaround to allow static analysis to infer the types of
        // the `pure` function.
        $pure =
            /**
             * @param a $x
             * @return Identity<a>
             */
            function ($x) {
                return Identity::of($x);
            };

        MonadLaws::test(
            [$this, 'assertEquals'],
            $x,
            $pure,
            // PHPStan seems to have lost track of `a` here, and is unable to
            // infer that `$f` should be callable(a): Identity<b>. It seems to
            // have inferred that `$f` is callable(mixed): Identity<b>.
            // @phpstan-ignore argument.type
            $f,
            $g
        );
    }

    /**
     * @return array{Identity: array<string, mixed>}
     */
    public static function provideData(): array
    {
        $addOne = function (int $x) {
            return Identity::of($x + 1);
        };
        $addTwo = function (int $x) {
            return Identity::of($x + 2);
        };

        return [
            'Identity' => [
                'x' => 10,
                'f' => $addOne,
                'g' => $addTwo,
            ],
        ];
    }
}
