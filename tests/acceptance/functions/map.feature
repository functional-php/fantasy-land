Feature: map
  In order to use map
  As a Psalm user
  I need Psalm to typecheck function

  Background:
    Given I have the default psalm configuration
    And I have the default code preamble

  Scenario: Asserting psalm recognizes return type
    Given I have the following code
      """
      $monad = new FakeMonad('foo');
      /** @psalm-trace $result */
      $result = f\map(function (string $a): int { return 2; });
      /** @psalm-trace $value */
      $value = f\map(function (string $a): int { return 2; }, $monad);
      """
    When I run psalm
    Then I see these errors
      | Type  | Message |
      | Trace | $result: callable(FunctionalPHP\FantasyLand\Functor<string>):FunctionalPHP\FantasyLand\Functor<int(2)> |
      | Trace | $value: FunctionalPHP\FantasyLand\Functor<int(2)>                                                      |
    And I see no other errors
