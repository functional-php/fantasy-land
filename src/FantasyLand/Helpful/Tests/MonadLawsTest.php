<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand\Helpful\Tests;

use FunctionalPHP\FantasyLand\Helpful\MonadLaws;
use FunctionalPHP\FantasyLand\Useful\Identity;

class MonadLawsTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider provideData
     */
    public function test_if_identity_monad_obeys_the_laws($f, $g, $x)
    {
        MonadLaws::test(
            [$this, 'assertEquals'],
            Identity::of,
            $f,
            $g,
            $x
        );
    }

    /**
     * @return array{Identity: array<string, mixed>}
     */
    public static function provideData(): array
    {
        $addOne = function ($x) {
            return Identity::of($x + 1);
        };
        $addTwo = function ($x) {
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
