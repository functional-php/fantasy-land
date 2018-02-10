<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand;

interface Chain extends Apply
{
    /**
     * bind :: Monad m => (a -> m b) -> m b
     *
     * @param callable $function
     *
     * @return Chain
     */
    public function bind(callable $function);
}
