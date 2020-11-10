<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand;

/**
 * @template T
 */
interface Semigroup
{
    /**
     * Return result of applying one semigroup with another.
     *
     * @template T
     * @psalm-param Semigroup<T> $value
     * @psalm-return Semigroup<T>
     *
     * @param  Semigroup $value
     * @return Semigroup
     */
    public function concat(Semigroup $value): Semigroup;
}
