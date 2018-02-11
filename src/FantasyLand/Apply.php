<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand;

interface Apply extends Functor
{
    /**
     * @param Apply $b
     *
     * @return Apply
     */
    public function ap(Apply $b): Apply;
}
