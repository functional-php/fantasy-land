<?php

declare(strict_types=1);

namespace FunctionalPHP\FantasyLand\Useful;

use FunctionalPHP\FantasyLand;

/**
 * @template a
 * @implements FantasyLand\Monad<a>
 */
class Identity implements FantasyLand\Monad
{
    public const of = 'FunctionalPHP\FantasyLand\Useful\Identity::of';

    /**
     * @var a
     */
    private $value;

    /**
     * @inheritdoc
     * @template A
     * @param  A           $value
     * @return Identity<A>
     */
    public static function of($value)
    {
        return new Identity($value);
    }

    /**
     * @param a $value
     */
    private function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @inheritdoc
     * @template b
     * @param  callable(a): b $transformation
     * @return Identity<b>
     */
    public function map(callable $transformation): Identity
    {
        $fn =
            /**
             * This is a workaround so that static analysis tools can understand
             * the type signature of the callables.
             *
             * @param  a           $x
             * @return Identity<b>
             */
            static function ($x) use ($transformation): Identity {
                return Identity::of($transformation($x));
            };

        /** @var Identity<b> */
        return $this->bind($fn);
    }

    /**
     * @inheritdoc
     *
     * TODO: Not sure how to write the type signature for this method; it seems
     *       to rely on the current `a` type being a subtype of `callable(b): c`
     *       which cannot be guaranteed by the type system as this may have been
     *       instantiated with any type. Calling `->ap(...)` on an instance of
     *       `Identity` with a non-callable value will result in a runtime error
     *       that cannot be caught by the type system. Additionally, if the
     *       `Identity` instance has a callable value, we still cannot guarentee
     *       that the types line up correctly, so really anything could happen
     *       here.
     *
     * @template b
     * @param  Identity<b>           $applicative
     * @return Identity<mixed>|never
     */
    public function ap(FantasyLand\Apply $applicative): FantasyLand\Apply
    {
        $value = $this->value;

        if (!is_callable($value)) {
            throw new \TypeError('Cannot call `ap` on an Identity instance with a non-callable value');
        }

        /**
         * Being optimistic and hoping that _if_ $value is callable then the
         * types should line up correctly (assuming the user of the function
         * hasn't provided a callable of a different type).
         *
         * @var callable(b): mixed $value
         */
        return $applicative->map($value);
    }

    /**
     * @inheritdoc
     */
    public function bind(callable $transformation)
    {
        return $transformation($this->value);
    }
}
