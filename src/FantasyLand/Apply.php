<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand;

/**
 * @template T
 * @template-extends Functor<T>
 */
interface Apply extends Functor
{
    /**
     * @template U
     * @psalm-param Apply<U> $applicative
     * @psalm-return Apply<mixed>
     *
     * @param Apply $applicative
     *
     * @return Apply
     */
    public function ap(Apply $applicative): Apply;
}
