<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand;

/**
 * @deprecated
 */
interface Pointed
{
    /**
     * Put $value in default minimal context.
     *
     * @psalm-suppress MissingParamType
     * @psalm-suppress MissingReturnType
     */
    public static function of($value);
}
