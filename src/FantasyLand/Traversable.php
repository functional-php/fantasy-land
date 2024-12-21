<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand;

/**
 * @template a
 * @extends Functor<a>
 */
interface Traversable extends Functor
{
    /**
     * traverse :: Applicative f => (a -> f b) -> f (t b)
     *
     * Where the `a` is value inside of container.
     *
     * @template b
     *
     * @param callable(a): Applicative<b> $fn (a -> f b)
     *
     * @return Applicative<Traversable<b>> f (t b)
     */
    public function traverse(callable $fn);
}
