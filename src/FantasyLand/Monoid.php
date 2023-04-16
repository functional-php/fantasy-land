<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand;

/**
 * @template a
 * @template-extends Semigroup<a>
 */
interface Monoid extends Semigroup
{
    /**
     * Return identity element for given Semigroup
     *
     * @return Monoid<a>
     */
    public static function mempty();
}
