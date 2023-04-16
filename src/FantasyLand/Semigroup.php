<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand;

/**
 * @template a
 */
interface Semigroup
{
    /**
     * Return result of applying one semigroup with another.
     *
     * @param  Semigroup<a> $value
     * @return Semigroup<a>
     */
    public function concat(Semigroup $value): Semigroup;
}
