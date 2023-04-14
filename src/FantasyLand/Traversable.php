<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand;

/**
 * @template a
 * @template-extends Functor<a>
 */
interface Traversable extends Functor
{
    /**
     * traverse :: Applicative f => (a -> f b) -> f (t b)
     *
     * Where the `a` is value inside of container.
     *
     * @template b
     * @template fn of callable(a): Applicative<b>
     *
     * @param fn $fn (a -> f b)
     *
     * @return Applicative<Traversable<b>> f (t b)
     */
    public function traverse(callable $fn);
}
