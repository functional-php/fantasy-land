<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand\Helpful\Tests;

use FunctionalPHP\FantasyLand\Applicative;
use FunctionalPHP\FantasyLand\Helpful\ApplicativeLaws;
use FunctionalPHP\FantasyLand\Useful\Identity;

class ApplicativeLawsTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider provideApplicativeTestData
     *
     * @template a
     * @template b
     * @template c
     * @template d
     *
     * @param a                           $x
     * @param Applicative<callable(a): b> $u
     * @param Applicative<callable(b): c> $v
     * @param Applicative<callable(c): d> $w
     * @param callable(a): b              $f
     */
    public function test_it_should_obey_applicative_laws(
        $x,
        Applicative $u,
        Applicative $v,
        Applicative $w,
        callable $f
    ): void {
        // This is a workaround to allow static analysis to infer the types of
        // the `pure` function.
        $pure =
            /**
             * @param  a           $x
             * @return Identity<a>
             */
            function ($x) {
                return Identity::of($x);
            };

        ApplicativeLaws::test(
            [$this, 'assertEquals'],
            $x,
            $pure,
            $u,
            $v,
            $w,
            $f
        );
    }

    /**
     * @return array{default: array<string, mixed>}
     */
    public static function provideApplicativeTestData()
    {
        return [
            'default' => [
                'x' => 33,
                'u' => Identity::of(function () {
                    return 1;
                }),
                'v' => Identity::of(function () {
                    return 5;
                }),
                'w' => Identity::of(function () {
                    return 7;
                }),
                'f' => function (int $x) {
                    return $x + 400;
                }
            ],
        ];
    }
}
