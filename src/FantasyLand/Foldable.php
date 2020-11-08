<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand;

/**
 * @template T
 */
interface Foldable
{
    /**
     * reduce :: (b -> a -> b) -> b -> b
     *
     * @template A
     * @psalm-param callable(A, T): A $function
     * @psalm-param A $accumulator
     * @psalm-return A
     *
     * @param callable $function    Binary function ($accumulator, $value)
     * @param mixed    $accumulator Value to witch reduce
     *
     * @return mixed Same type as $accumulator
     */
    public function reduce(callable $function, $accumulator);
}
