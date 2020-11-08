<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand\Useful;

use FunctionalPHP\FantasyLand;

/**
 * @template T
 * @template-implements FantasyLand\Monad<T>
 */
class Identity implements FantasyLand\Monad
{
    const of = 'FunctionalPHP\FantasyLand\Useful\Identity::of';

    /**
     * @psalm-var T
     * @var mixed
     */
    private $value;

    /**
     * @inheritdoc
     * @template U
     * @psalm-param U $value
     * @psalm-return Identity<U>
     *
     * @param  mixed    $value
     * @return Identity
     */
    public static function of($value)
    {
        return new self($value);
    }

    /**
     * @psalm-param T $value
     * @param mixed $value
     */
    private function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @inheritdoc
     * @template F
     * @psalm-param callable(T): F $function
     * @psalm-return Identity<F>
     */
    public function map(callable $function): FantasyLand\Functor
    {
        return static::of($function($this->value));
    }

    /**
     * @inheritdoc
     * @template U
     * @template R
     * @template F of callable(U): R
     * @psalm-param FantasyLand\Apply<U> $applicative
     * @psalm-return (T is F ? Identity<R> : never-return)
     */
    public function ap(FantasyLand\Apply $applicative): FantasyLand\Apply
    {
        $function = $this->value;

        if (! $applicative instanceof self) {
            throw new \LogicException(sprintf('Applicative must be an instance of %s', self::class));
        }

        if (! is_callable($function)) {
            throw new \LogicException(sprintf('Applicative can only be called on an instance of %s<callable(a): b>', self::class));
        }

        /** @psalm-var F $function */
        return $applicative->map($function);
    }

    /**
     * @inheritdoc
     */
    public function bind(callable $function)
    {
        return $function($this->value);
    }
}
