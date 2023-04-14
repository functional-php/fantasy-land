<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand;

/**
 * @template a
 */
interface Pointed
{
    /**
     * Put $value in default minimal context.
     *
     * @param a $value
     *
     * @return Pointed<a>
     */
    public static function of($value);
}
