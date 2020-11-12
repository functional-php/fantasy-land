<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand;

/**
 * @template T
 * @template-extends Semigroup<T>
 */
interface Monoid extends Semigroup
{
    /**
     * Return identity element for given Semigroup
     *
     * @return Monoid<T>
     */
    public static function mempty();
}
