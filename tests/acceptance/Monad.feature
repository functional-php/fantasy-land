Feature: Monad
  In order to use Monad
  As a Psalm user
  I need Psalm to typecheck methods

  Background:
    Given I have the default psalm configuration
    And I have the default code preamble

  Scenario: Asserting of :: Applicative f => a -> f a
    Given I have the following code
      """
      /** @psalm-trace $monad */
      $monad = FakeMonad::of('foo');
      """
    When I run psalm
    Then I see these errors
      | Type  | Message |
      | Trace | $monad: FunctionalPHP\FantasyLand\Applicative<string(foo)>                                                    |
    And I see no other errors

  Scenario: Asserting map :: Functor f => f a ~> (a -> b) -> f b
    Given I have the following code
      """
      $monad = FakeMonad::of('foo');
      $function = function (string $a): int {
          return random_int(-1, 1);
      };
      /** @psalm-trace $value */
      $value = $monad->map($function);
      """
    When I run psalm
    Then I see these errors
      | Type  | Message |
      | Trace | $value: FunctionalPHP\FantasyLand\Functor<int>                                                    |
    And I see no other errors

  Scenario: Asserting ap :: Apply f => f a ~> f (a -> b) -> f b
    Given I have the following code
      """
      $function = function (string $a): int {
          return strlen($a);
      };
      $monad = FakeMonad::of($function);
      $ap = FakeMonad::of('foo');
      /** @psalm-trace $value */
      $value = $monad->ap($ap);
      """
    When I run psalm
    Then I see these errors
      | Type  | Message |
      | Trace | $value: FunctionalPHP\FantasyLand\Apply<mixed>                                                    |
    And I see no other errors

  Scenario: Asserting bind :: Chain m => m a ~> (a -> m b) -> m b
    Given I have the following code
      """
      $monad = new FakeMonad('foo');
      $function = function (string $a): f\Monad {
          return new FakeMonad(2);
      };
      /** @psalm-trace $value */
      $value = $monad->bind($function);
      """
    When I run psalm
    Then I see these errors
      | Type  | Message |
      | Trace | $value: FakeMonad<int(2)>                                                    |
    And I see no other errors

  Scenario: Asserting bind :: Monad m => m a ~> (a -> m b) -> m b
    Given I have the following code
      """
      $monad = new FakeMonad('foo');
      $function = function (string $a): f\Monad {
          return new FakeMonad(2);
      };
      /** @psalm-trace $value */
      $value = $monad->bind($function);
      """
    When I run psalm
    Then I see these errors
      | Type  | Message |
      | Trace | $value: FakeMonad<int(2)>                                                    |
    And I see no other errors
