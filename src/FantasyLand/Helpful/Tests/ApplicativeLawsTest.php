<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand\Helpful\Tests;

use FunctionalPHP\FantasyLand\Applicative;
use FunctionalPHP\FantasyLand\Helpful\ApplicativeLaws;
use FunctionalPHP\FantasyLand\Useful\Identity;
use PHPUnit\Framework\TestCase;

class ApplicativeLawsTest extends TestCase
{
    /**
     * @dataProvider provideApplicativeTestData
     * @template T
     * @psalm-param Applicative<T> $u
     * @psalm-param Applicative<T> $v
     * @psalm-param Applicative<T> $w
     * @psalm-param callable(T): T $f
     * @psalm-param T $x
     */
    public function test_it_should_obey_applicative_laws(
        Applicative $u,
        Applicative $v,
        Applicative $w,
        callable $f,
        $x
    ): void {
        ApplicativeLaws::test(
            [$this, 'assertEquals'],
            Identity::of,
            $u,
            $v,
            $w,
            $f,
            $x
        );
    }

    public function provideApplicativeTestData(): array
    {
        return [
            'default' => [
                '$u' => Identity::of(function () {
                    return 1;
                }),
                '$v' => Identity::of(function () {
                    return 5;
                }),
                '$w' => Identity::of(function () {
                    return 7;
                }),
                '$f' => function (int $x) {
                    return $x + 400;
                },
                '$x' => 33
            ],
        ];
    }
}
