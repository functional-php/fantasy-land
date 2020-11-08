Feature: bind
  In order to use bind
  As a Psalm user
  I need Psalm to typecheck function

  Background:
    Given I have the default psalm configuration
    And I have the default code preamble

  Scenario: Asserting psalm recognizes return type
    Given I have the following code
      """
      $monad = new FakeMonad('foo');
      $function = function (string $a): f\Monad { return new FakeMonad(2); };
      /** @psalm-trace $result */
      $result = f\bind($function);
      /** @psalm-trace $value */
      $value = f\bind($function, $monad);
      """
    When I run psalm
    Then I see these errors
      | Type  | Message |
      | Trace | $result: callable(FunctionalPHP\FantasyLand\Monad<string>):FakeMonad<int(2)> |
      | Trace | $value: FakeMonad<int(2)>                                                    |
    And I see no other errors
