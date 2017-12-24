<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand;

interface Monoid extends Semigroup
{
    /**
     * Return identity element for given Semigroup
     *
     * @return Monoid
     */
    public static function mempty();
}
