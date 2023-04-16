<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand;

/**
 * @template a
 * @template-extends Apply<a>
 */
interface Chain extends Apply
{
    /**
     * bind :: Monad m => (a -> m b) -> m b
     *
     * @template b
     * @template f of callable(a): Chain<b>
     *
     * @param f $function
     *
     * @return Chain<b>
     */
    public function bind(callable $function);
}
