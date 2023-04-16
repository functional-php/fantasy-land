<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand;

/**
 * @template a
 * @template-extends Functor<a>
 */
interface Apply extends Functor
{
    /**
     * @template b
     *
     * @param Apply<b> $b
     *
     * @return Apply<b>
     */
    public function ap(Apply $b): Apply;
}
