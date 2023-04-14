<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand;

/**
 * @template a
 * @template-extends Applicative<a>
 * @template-extends Chain<a>
 */
interface Monad extends
    Applicative,
    Chain
{
}
