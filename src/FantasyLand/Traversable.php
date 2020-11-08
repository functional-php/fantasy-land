<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand;

/**
 * @template T
 * @template-extends Functor<T>
 */
interface Traversable extends Functor
{
    /**
     * traverse :: Applicative f => (a -> f b) -> f (t b)
     *
     * Where the `a` is value inside of container.
     *
     * @template A as Applicative
     * @psalm-param callable(T): A $function
     * @psalm-return A
     *
     * @param callable $function (a -> f b)
     *
     * @return Applicative f (t b)
     */
    public function traverse(callable $function);
}
