<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand;

const identity = 'FunctionalPHP\FantasyLand\identity';

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

function concat(Semigroup $a, Semigroup $b): Semigroup
{
    return $a->concat($b);
}

const emptyy = 'FunctionalPHP\FantasyLand\emptyy';

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
 * @return mixed|\Closure
 *
 * @param callable $transformation
 * @param Functor  $value
 */
function map(callable $transformation, Functor $value = null)
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
 * @return mixed|\Closure
 *
 * @param callable $function
 * @param Monad    $value
 */
function bind(callable $function, Monad $value = null)
{
    return curryN(2, function (callable $function, Monad $value) {
        return $value->bind($function);
    })(...func_get_args());
}

/**
 * @var callable
 */
const compose = 'FunctionalPHP\FantasyLand\compose';

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
 * @param mixed    $x
 * @param callable $f
 *
 * @return mixed
 */
function applicator($x, callable $f = null)
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
