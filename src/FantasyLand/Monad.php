<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand;

/**
 * @template T
 * @template-extends Applicative<T>
 * @template-extends Chain<T>
 */
interface Monad extends
    Applicative,
    Chain
{
}
