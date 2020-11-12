<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand\Helpful\Tests;

use FunctionalPHP\FantasyLand\Helpful\MonadLaws;
use FunctionalPHP\FantasyLand\Useful\Identity;
use PHPUnit\Framework\TestCase;

class MonadLawsTest extends TestCase
{
    /**
     * @dataProvider provideData
     * @psalm-param callable(int): \FunctionalPHP\FantasyLand\Monad<int> $f
     * @psalm-param callable(int): \FunctionalPHP\FantasyLand\Monad<int> $g
     * @psalm-param int $x
     */
    public function test_if_identity_monad_obeys_the_laws($f, $g, $x): void
    {
        MonadLaws::test(
            [$this, 'assertEquals'],
            Identity::of,
            $f,
            $g,
            $x
        );
    }

    public function provideData(): array
    {
        $addOne = function (int $x): Identity {
            return Identity::of($x + 1);
        };
        $addTwo = function (int $x): Identity {
            return Identity::of($x + 2);
        };

        return [
            'Identity' => [
                '$f' => $addOne,
                '$g' => $addTwo,
                '$x' => 10,
            ],
        ];
    }
}
