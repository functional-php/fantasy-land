<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand;

const identity = 'FunctionalPHP\FantasyLand\identity';

/**
 * @template T
 * @psalm-param T $a
 * @psalm-return T
 *
 * @param  mixed $a
 * @return mixed
 */
function identity($a)
{
    return $a;
}

const equal = 'FunctionalPHP\FantasyLand\equal';

function equal(Setoid $a, Setoid $b): bool
{
    return $a->equals($b);
}

const concat = 'FunctionalPHP\FantasyLand\concat';

/**
 * @template T
 * @psalm-param Semigroup<T> $a
 * @psalm-param Semigroup<T> $b
 * @psalm-return Semigroup<T>
 */
function concat(Semigroup $a, Semigroup $b): Semigroup
{
    return $a->concat($b);
}

const emptyy = 'FunctionalPHP\FantasyLand\emptyy';

/**
 * @template T
 * @psalm-param Monoid<T> $a
 * @psalm-return Monoid<T>
 */
function emptyy(Monoid $a): Monoid
{
    return $a::mempty();
}


/**
 * @var callable
 */
const map = 'FunctionalPHP\FantasyLand\map';

/**
 * map :: Functor f => (a -> b) -> f a -> f b
 *
 * @template T
 * @template U
 * @template R as Functor<T>|null
 *
 * @psalm-param callable(T): U $function
 * @psalm-param R $value
 * @psalm-return (R is null ? (callable(Functor<T>): Functor<U>) : Functor<U>)
 *
 * @param  callable       $function
 * @param  null|Functor   $value
 * @return mixed|callable
 */
function map(callable $function, Functor $value = null)
{
    return null !== $value
        ? $value->map($function)
        : function (Functor $value) use ($function): Functor {
            return $value->map($function);
        };
}

/**
 * @var callable
 */
const bind = 'FunctionalPHP\FantasyLand\bind';

/**
 * bind :: Monad m => (a -> m b) -> m a -> m b
 *
 * @template T
 * @template U of Monad
 * @template V as Monad<T>|null
 *
 * @psalm-param callable(T): U $function
 * @psalm-param V $value
 * @psalm-return (V is null ? (callable(Monad<T>): U) : U)
 *
 * @param  callable       $function
 * @param  null|Monad     $value
 * @return mixed|callable
 */
function bind(callable $function, Monad $value = null)
{
    return null !== $value
        ? $value->bind($function)
        :
        /**
         * @psalm-param Monad<T> $value
         * @psalm-return U
         */
        function (Monad $value) use ($function): Monad {
            return $value->bind($function);
        };
}

/**
 * @var callable
 */
const compose = 'FunctionalPHP\FantasyLand\compose';

/**
 * @template T
 * @template F
 * @template G
 * @psalm-param callable(G): F $f
 * @psalm-param callable(T): G $g
 * @psalm-return callable(T): F
 */
function compose(callable $f, callable $g): callable
{
    return function ($x) use ($f, $g) {
        return $f($g($x));
    };
}

/**
 * @var callable
 */
const applicator = 'FunctionalPHP\FantasyLand\applicator';

/**
 * applicator :: a -> (a -> b) -> b
 *
 * @todo Improve type check for callable return type
 * @template T
 * @template V
 * @psalm-param T $x
 * @psalm-param null|callable(T): V $function
 * @psalm-return (func_num_args() is 1 ? (callable(callable(T): mixed): mixed) : V)
 *
 * @param mixed         $x
 * @param null|callable $function
 *
 * @return mixed
 */
function applicator($x, callable $function = null)
{
    return null !== $function
        ? $function($x)
        :
        /**
         * @psalm-param callable(T): V $function
         * @psalm-return V
         */
        function (callable $function) use ($x) {
            return $function($x);
        };
}

/**
 * Curry function
 *
 * @deprecated
 *
 * @template T
 * @template A of list<T>|array<array-key, T>
 * @psalm-param A $args
 * @psalm-return callable
 *
 * @param  int      $numberOfArguments
 * @param  array    $args
 * @param  callable $function
 * @return callable
 */
function curryN(int $numberOfArguments, callable $function, array $args = []): callable
{
    return
        /**
         * @psalm-param T ...$argsNext
         * @psalm-return mixed
         */
        function (...$argsNext) use ($numberOfArguments, $function, $args) {
            $argsLeft = $numberOfArguments - func_num_args();

            return $argsLeft <= 0
                ? $function(...push_($args, $argsNext))
                : curryN($argsLeft, $function, push_($args, $argsNext));
        };
}

/**
 * @var callable
 */
const push_ = 'FunctionalPHP\FantasyLand\push_';

/**
 * push_ :: array[a] -> array[a] -> array[a]
 *
 * Append array with values.
 * Mutation on the road! watch out!!
 *
 * @template T
 * @template U
 * @psalm-param array<array-key, T> $array
 * @psalm-param array<array-key, U> $values
 * @psalm-return array<array-key, T|U>
 *
 * @param array $array
 * @param array $values
 *
 * @return array
 */
function push_(array $array, array $values): array
{
    foreach ($values as $value) {
        $array[] = $value;
    }

    return $array;
}
