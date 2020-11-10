<?php

namespace FunctionalPHP\FantasyLand\Tests;

use FunctionalPHP\FantasyLand\Functor;

/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause()
 *
 * @SuppressWarnings(PHPMD)
*/
class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;

    /** @var array<string,string> */
    protected $config = [
        'psalm_path' => 'vendor/bin/psalm',
        'default_file' => 'somefile.php',
        'default_dir' => 'tests/_run/',
    ];

    /**
     * @Given I have the default psalm configuration
     */
    public function haveTheDefaultPsalmConfiguration(): void
    {
        $config = <<<'XML'
<?xml version="1.0" ?>
<psalm
  errorLevel="1"
  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
  xmlns="https://getpsalm.org/schema/config"
  xsi:schemaLocation="https://getpsalm.org/schema/config vendor/vimeo/psalm/config.xsd"
>
    <projectFiles>
          <directory name="." />
    </projectFiles>
  
    <issueHandlers>
        <DeprecatedInterface errorLevel="suppress" />
    </issueHandlers>
</psalm>
XML;


        $this->haveTheFollowingConfig($config);
    }

    /**
     * @Given I have the default code preamble
     */
    public function haveTheDefaultCodePreamble(): void
    {
        $code = <<<'CODE'
<?php

use FunctionalPHP\FantasyLand as f;

/**
 * @template T
 * @template-implements f\Monad<T>
 */
class FakeMonad implements f\Monad
{
  /**
   * @psalm-param T $value
   */
  public function __construct($value)
  {
  }

  /** @psalm-suppress InvalidReturnType */
  public function ap(f\Apply $b): f\Apply
  {
  }

  /** @psalm-suppress InvalidReturnType */
  public function bind(callable $function)
  {
  }

  /** @psalm-suppress InvalidReturnType */
  public function map(callable $function): f\Functor
  {
  }

  /** @psalm-suppress InvalidReturnType */
  public static function of($value)
  {
  }
}

/**
 * @template T
 * @template-implements f\Foldable<T>
 */
class FakeFoldable implements f\Foldable
{
  /**
   * @psalm-param T $value
   */
  public function __construct($value)
  {
  }
  
  /** @psalm-suppress InvalidReturnType */
  public function reduce(callable $function, $accumulator)
  {
  }
}

/**
 * @template T
 * @template-implements f\Monoid<T>
 */
class FakeMonoid implements f\Monoid
{
  /**
   * @psalm-param T $value
   */
  public function __construct($value)
  {
  }
  
  /** @psalm-suppress InvalidReturnType */
  public static function mempty()
  {
  }
  
  /** @psalm-suppress InvalidReturnType */
  public function concat(f\Semigroup $value): f\Semigroup
  {
  }
}

/**
 * @template T
 * @template-implements f\Traversable<T>
 */
class FakeTraversable implements f\Traversable
{
    /**
     * @psalm-param T $value
     */
    public function __construct($value)
    {
    }
    
    /** @psalm-suppress InvalidReturnType */
    public function map(callable $function): f\Functor
    {
    }
  
    /** @psalm-suppress InvalidReturnType */
    public function traverse(callable $function)
    {}
}

CODE;

        $this->haveTheFollowingCodePreamble($code);
    }
}
