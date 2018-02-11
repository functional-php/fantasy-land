# FantasyLand
## Introduction

Specification for interoperability of common algebraic structures in PHP.
The inspiration for this package is taken from fantastic project [fantasyland](https://github.com/fantasyland/fantasy-land) `[A]`.

You can find following algebraic structures:
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

Each algebraic structure must obey some laws. 
To simplify verification of those laws, 
this project provides encapsulated property tests, 
that can be used to easily verify correctness of a newly implemented structures. 

- [Setoid Laws](src/FantasyLand/Helpful/SetoidLaws.php)
- [Monoid Laws](src/FantasyLand/Helpful/MonoidLaws.php)
- [Functor Laws](src/FantasyLand/Helpful/FunctorLaws.php)
- [Applicative Laws](src/FantasyLand/Helpful/ApplicativeLaws.php)
- [Monad Laws](src/FantasyLand/Helpful/MonadLaws.php)

Examples how to use property tests can be found in the [directory of examples](src/FantasyLand/Helpful/Tests)

## Projects that are using FantasyLand
- [widmogrod/php-functional](https://github.com/widmogrod/php-functional)

## References
- [A] https://github.com/fantasyland/fantasy-land
