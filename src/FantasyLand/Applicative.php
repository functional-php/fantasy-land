<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand;

/**
 * @template T
 * @template-extends Apply<T>
 */
interface Applicative extends
    Apply
{
    /**
     * Put $value in default minimal context.
     *
     * @template U
     * @psalm-param U $value
     * @psalm-return Applicative<U>
     *
     * @param  mixed $value
     * @return mixed
     */
    public static function of($value);
}
