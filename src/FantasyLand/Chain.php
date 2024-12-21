<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand;

/**
 * @template a
 * @extends Apply<a>
 */
interface Chain extends Apply
{
    /**
     * bind :: Monad m => (a -> m b) -> m b
     *
     * @template b
     *
     * @param callable(a): Chain<b> $function
     *
     * @return Chain<b>
     */
    public function bind(callable $function);
}
