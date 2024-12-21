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
     * @template A
     *
     * @param A $value
     *
     * @return Pointed<A>
     */
    public static function of($value);
}
