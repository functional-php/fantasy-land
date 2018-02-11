<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand\Useful;

use FunctionalPHP\FantasyLand;

class Identity implements FantasyLand\Monad
{
    const of = 'FunctionalPHP\FantasyLand\Useful\Identity::of';

    /**
     * @var mixed
     */
    private $value;

    /**
     * @inheritdoc
     */
    public static function of($value)
    {
        return new self($value);
    }

    private function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @inheritdocus
     */
    public function map(callable $transformation): FantasyLand\Functor
    {
        return static::of($this->bind($transformation));
    }

    /**
     * @inheritdoc
     */
    public function ap(FantasyLand\Apply $applicative): FantasyLand\Apply
    {
        return $applicative->map($this->value);
    }

    /**
     * @inheritdoc
     */
    public function bind(callable $transformation)
    {
        return $transformation($this->value);
    }
}
