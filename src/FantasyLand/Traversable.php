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
     * @template B
     * @psalm-param callable(T): Applicative<B> $function
     * @psalm-return Applicative<Traversable<B>>
     *
     * @param callable $function (a -> f b)
     *
     * @return Applicative f (t b)
     */
    public function traverse(callable $function);
}
