<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand\Helpful\Tests;

use FunctionalPHP\FantasyLand\Functor;
use FunctionalPHP\FantasyLand\Helpful\FunctorLaws;
use FunctionalPHP\FantasyLand\Useful\Identity;

class FunctorLawsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provideFunctorTestData
     */
    public function test_it_should_obey_functor_laws(
        callable $f,
        callable $g,
        Functor $x
    ) {
        FunctorLaws::test(
            [$this, 'assertEquals'],
            $f,
            $g,
            $x
        );
    }

    public function provideFunctorTestData()
    {
        return [
            'Identity' => [
                '$f' => function ($x) {
                    return $x + 1;
                },
                '$g' => function ($x) {
                    return $x + 5;
                },
                '$x' => Identity::of(123),
            ],
        ];
    }
}
