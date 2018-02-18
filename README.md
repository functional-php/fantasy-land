# FantasyLand [![Build Status](https://travis-ci.org/functional-php/fantasy-land.svg?branch=master)](https://travis-ci.org/functional-php/fantasy-land)
## Introduction

This project specifies interoperability of common algebraic structures in PHP.
The inspiration for this package is the fantastic [fantasyland](https://github.com/fantasyland/fantasy-land) project `[A]`.

The repository contains the following algebraic structures:
- [Setoid](src/FantasyLand/Setoid.php)
- [Semigroup](src/FantasyLand/Semigroup.php)
- [Monoid](src/FantasyLand/Monoid.php)
- [Functor](src/FantasyLand/Functor.php)
- [Apply](src/FantasyLand/Apply.php)
- [Applicative](src/FantasyLand/Applicative.php)
- [Foldable](src/FantasyLand/Foldable.php)
- [Traversable](src/FantasyLand/Traversable.php)
- [Chain](src/FantasyLand/Chain.php)
- [Monad](src/FantasyLand/Monad.php)
- [Pointed](src/FantasyLand/Pointed.php)

Each of those algebraic structures must obey some laws.
In order to simplify their verification, the project provides encapsulated property tests.
They can be used to easily verify the correctness of newly implemented structures.

- [Setoid Laws](src/FantasyLand/Helpful/SetoidLaws.php)
- [Monoid Laws](src/FantasyLand/Helpful/MonoidLaws.php)
- [Functor Laws](src/FantasyLand/Helpful/FunctorLaws.php)
- [Applicative Laws](src/FantasyLand/Helpful/ApplicativeLaws.php)
- [Monad Laws](src/FantasyLand/Helpful/MonadLaws.php)

You can find exemples on how to use those tests in the [directory of examples](src/FantasyLand/Helpful/Tests)

## Installation
```
composer require functional-php/fantasy-land:^1
```

## Projects that are using FantasyLand
- [widmogrod/php-functional](https://github.com/widmogrod/php-functional)

## References
- [A] https://github.com/fantasyland/fantasy-land
