<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand;

const identity = 'FunctionalPHP\FantasyLand\identity';

/**
 * @template a
 *
 * @param a $a
 *
 * @return a
 */
function identity($a)
{
    return $a;
}

const equal = 'FunctionalPHP\FantasyLand\equal';

/**
 * @template a
 * @template b
 *
 * @param Setoid<a> $a
 * @param Setoid<b> $b
 *
 * @return bool
 */
function equal(Setoid $a, Setoid $b): bool
{
    return $a->equals($b);
}

const concat = 'FunctionalPHP\FantasyLand\concat';

/**
 * @template a
 *
 * @param Semigroup<a> $a
 * @param Semigroup<a> $b
 *
 * @return Semigroup<a>
 */
function concat(Semigroup $a, Semigroup $b): Semigroup
{
    return $a->concat($b);
}

const emptyy = 'FunctionalPHP\FantasyLand\emptyy';

/**
 * @template a
 *
 * @param Monoid<a> $a
 *
 * @return Monoid<a>
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
 * @template a
 * @template b
 *
 * @param callable(a): b  $transformation
 * @param Functor<a>|null $value
 *
 * @return Functor<b>|(callable(Functor<a>): Functor<b>) If a functor was provided directly to map, returns the result
 *                                                       of applying the transformation to the value. Otherwise, returns
 *                                                       a curried function that expects a functor.
 */
function map(callable $transformation, ?Functor $value = null)
{
    /** @var Functor<b>|(callable(Functor<a>): Functor<b>) */
    return curryN(2, function (callable $transformation, Functor $value) {
        return $value->map($transformation);
    })(...func_get_args());
}

/**
 * @var callable
 */
const bind = 'FunctionalPHP\FantasyLand\bind';

/**
 * bind :: Monad m => (a -> m b) -> m a -> m b
 *
 * @template a
 * @template b
 *
 * @param callable(a): Monad<b> $function
 * @param Monad<a>|null         $value
 *
 * @return Monad<b>|(callable(Monad<a>): Monad<b>) If a monad was provided directly to bind, returns the result.
 *                                                 Otherwise, returns a curried function that expects a monad.
 */
function bind(callable $function, ?Monad $value = null)
{
    /** @var Monad<b>|(callable(Monad<a>): Monad<b>) */
    return curryN(2, function (callable $function, Monad $value): Monad {
        /**
         * @var callable(a): Monad<b> $function
         * @var Monad<a>              $value
         */
        /** @var Monad<b> */
        return $value->bind($function);
    })(...func_get_args());
}

/**
 * @var callable
 */
const compose = 'FunctionalPHP\FantasyLand\compose';

/**
 * @template a
 * @template b
 * @template c
 *
 * @param  callable(b): c $f
 * @param  callable(a): b $g
 * @return callable(a): c
 */
function compose(callable $f, callable $g): callable
{
    return /** @param a $x */ function ($x) use ($f, $g) {
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
 * @template a
 * @template b
 *
 * @param a                   $x
 * @param callable(a): b|null $f
 *
 * @return b|(callable(callable(a): b): b) If a function was provided directly to applicator, returns the result of
 *                                         applying the function to the value. Otherwise, returns a curried function
 *                                         that expects said function.
 */
function applicator($x, ?callable $f = null)
{
    return curryN(
        2,
        /**
         * @param  a              $x
         * @param  callable(a): b $f
         * @return b
         */
        function ($x, callable $f) {
            return $f($x);
        }
    )(...func_get_args());
}

/**
 * Curry function
 *
 * @param int      $numberOfArguments
 * @param callable $function
 * @param mixed[]  $args
 *
 * @return callable
 */
function curryN($numberOfArguments, callable $function, array $args = [])
{
    return
        /**
         * @param mixed ...$argsNext
         *
         * @return mixed|callable
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
 * @template a
 *
 * @param array<a> $array
 * @param array<a> $values
 *
 * @return array<a>
 */
function push_(array $array, array $values): array
{
    foreach ($values as $value) {
        $array[] = $value;
    }

    return $array;
}
