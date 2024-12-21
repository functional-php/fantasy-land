<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand;

/**
 * @template a
 */
interface Foldable
{
    /**
     * reduce :: (b -> a -> b) -> b -> b
     *
     * @template b
     *
     * @param callable(b, a): b $function    Binary function ($accumulator, $value)
     * @param b                 $accumulator Value to witch reduce
     *
     * @return b Same type as $accumulator
     */
    public function reduce(callable $function, $accumulator);
}
