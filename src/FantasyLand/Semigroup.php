<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand;

interface Semigroup
{
    /**
     * Return result of applying one semigroup with another.
     *
     * @param  self $value
     * @return self
     */
    public function concat(self $value): self;
}
