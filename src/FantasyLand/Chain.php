<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand;

/**
 * @template T
 * @template-extends Apply<T>
 */
interface Chain extends Apply
{
    /**
     * bind :: Chain m => m a ~> (a -> m b) -> m b
     *
     * @template U of Chain
     * @psalm-param callable(T): U $function
     * @psalm-return U
     *
     * @param callable $function
     *
     * @return Chain
     */
    public function bind(callable $function);
}
