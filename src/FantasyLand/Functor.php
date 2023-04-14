<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand;

/**
 * @template a
 */
interface Functor
{
    /**
     * map :: Functor f => (a -> b) -> f b
     *
     * @template b
     * @template f of callable(a): b
     *
     * @param f $function
     *
     * @return Functor<b>
     */
    public function map(callable $function): Functor;
}
