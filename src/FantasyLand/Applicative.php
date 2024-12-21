<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand;

/**
 * @template a
 * @extends Apply<a>
 * @extends Pointed<a>
 */
interface Applicative extends
    Apply,
    Pointed
{
}
