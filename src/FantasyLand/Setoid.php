<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand;

interface Setoid
{
    /**
     * @param Setoid|mixed $other
     *
     * @return bool
     */
    public function equals($other): bool;
}
