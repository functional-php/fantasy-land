Feature: Identity
  In order to use Identity
  As a Psalm user
  I need Psalm to typecheck methods

  Background:
    Given I have the default psalm configuration
    And I have the default code preamble

  Scenario: Asserting psalm recognizes Identity type from of()
    Given I have the following code
      """
      use FunctionalPHP\FantasyLand\Useful\Identity;
      /** @psalm-trace $identityString */
      $identityString = Identity::of('foo');
      /** @psalm-trace $identityInt */
      $identityInt = Identity::of(5);
      """
    When I run psalm
    Then I see these errors
      | Type  | Message |
      | Trace | $identityString: FunctionalPHP\FantasyLand\Useful\Identity<string(foo)> |
      | Trace | $identityInt: FunctionalPHP\FantasyLand\Useful\Identity<int(5)>         |
    And I see no other errors

  Scenario: Asserting psalm recognizes return type of map()
    Given I have the following code
      """
      use FunctionalPHP\FantasyLand\Useful\Identity;
      $identity = Identity::of('foo');
      $function = function (string $a): int {
          return random_int(-1, 1);
      };
      /** @psalm-trace $value */
      $value = $identity->map($function);
      """
    When I run psalm
    Then I see these errors
      | Type  | Message |
      | Trace | $value: FunctionalPHP\FantasyLand\Useful\Identity<int> |
    And I see no other errors

  Scenario: Asserting psalm recognizes return type of bind()
    Given I have the following code
      """
      use FunctionalPHP\FantasyLand\Useful\Identity;
      use FunctionalPHP\FantasyLand\Useful\Chain;
      $identity = Identity::of('foo');
      $function = function (string $a): FakeMonad {
          return new FakeMonad(random_int(-1, 1));
      };
      /** @psalm-trace $value */
      $value = $identity->bind($function);
      """
    When I run psalm
    Then I see these errors
      | Type  | Message |
      | Trace | $value: FakeMonad<int> |
    And I see no other errors