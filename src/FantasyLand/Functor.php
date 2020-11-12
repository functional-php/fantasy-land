<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand;

/**
 * @template T
 */
interface Functor
{
    /**
     * map :: Functor f => f a ~> (a -> b) -> f b
     *
     * @template F
     * @psalm-param callable(T): F $function
     * @psalm-return Functor<F>
     *
     * @param callable $function
     *
     * @return Functor
     */
    public function map(callable $function): Functor;
}
