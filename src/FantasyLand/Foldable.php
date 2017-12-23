<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand;

interface Foldable
{
    /**
     * reduce :: (b -> a -> b) -> b -> b
     *
     * @param callable $function    Binary function ($accumulator, $value)
     * @param mixed    $accumulator Value to witch reduce
     *
     * @return mixed Same type as $accumulator
     */
    public function reduce(callable $function, $accumulator);
}
