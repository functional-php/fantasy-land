<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand\Helpful\Tests;

use FunctionalPHP\FantasyLand\Helpful\MonadLaws;
use FunctionalPHP\FantasyLand\Useful\Identity;

class MonadLawsTest extends \PHPUnit_Framework_TestCase
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

    public function provideData()
    {
        $addOne = function ($x) {
            return Identity::of($x + 1);
        };
        $addTwo = function ($x) {
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
