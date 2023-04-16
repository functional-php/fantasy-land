<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand;

/**
 * @template a
 * @template-extends Apply<a>
 * @template-extends Pointed<a>
 */
interface Applicative extends
    Apply,
    Pointed
{
}
