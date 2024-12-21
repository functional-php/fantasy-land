<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand;

/**
 * @template a
 */
interface Setoid
{
    /**
     * @template b
     *
     * @param Setoid<b> $other
     *
     * @return bool
     */
    public function equals($other): bool;
}
