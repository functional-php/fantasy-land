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
 * @template f of callable(a): b
 * @template next of callable(Functor<a>): Functor<b>
 *
 * @param f               $transformation
 * @param Functor<a>|null $value
 *
 * @return Functor<b>|next If a functor was provided directly to map, returns
 *                         the result of applying the transformation to the
 *                         value. Otherwise, returns a curried function that
 *                         expects a functor.
 */
function map(callable $transformation, ?Functor $value = null)
{
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
 * @template f of callable(a): Monad<b>
 * @template next of callable(Monad<a>): Monad<b>
 *
 * @param f             $function
 * @param Monad<a>|null $value
 *
 * @return Monad<b>|next If a monad was provided directly to bind, returns the
 *                       result. Otherwise, returns a curried function that
 *                       expects a monad.
 */
function bind(callable $function, ?Monad $value = null)
{
    return curryN(2, function (callable $function, Monad $value) {
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
 * @template f of callable(b): c
 * @template g of callable(a): b
 * @template composed of callable(a): c
 *
 * @param  f        $f
 * @param  g        $g
 * @return composed
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
 * @template f of callable(a): b
 * @template next of callable(f): b
 *
 * @param a      $x
 * @param f|null $f
 *
 * @return b|next If a function was provided directly to applicator, returns the
 *                result of applying the function to the value. Otherwise,
 *                returns a curried function that expects said function.
 */
function applicator($x, ?callable $f = null)
{
    return curryN(2, function ($x, callable $f) {
        return $f($x);
    })(...func_get_args());
}


/**
 * Curry function
 *
 * @param int      $numberOfArguments
 * @param callable $function
 * @param array    $args
 *
 * @return callable
 */
function curryN($numberOfArguments, callable $function, array $args = [])
{
    return function (...$argsNext) use ($numberOfArguments, $function, $args) {
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
