<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand;

/**
 * @template a
 * @extends Applicative<a>
 * @extends Chain<a>
 */
interface Monad extends
    Applicative,
    Chain
{
}
