Feature: Traversable
  In order to use Traversable
  As a Psalm user
  I need Psalm to typecheck methods

  Background:
    Given I have the default psalm configuration
    And I have the default code preamble

  Scenario: Asserting traverse :: Applicative f => (a -> f b) -> f (t b)
    Given I have the following code
      """
      $function = function (string $a): f\Applicative {
        return new FakeMonad(random_int(-1, 1));
      };
      $traversable = new FakeTraversable(str_shuffle('string'));
      /** @psalm-trace $value */
      $value = $traversable->traverse($function);
      """
    When I run psalm
    Then I see these errors
      | Type  | Message |
      | Trace | $value: FunctionalPHP\FantasyLand\Applicative<FunctionalPHP\FantasyLand\Traversable<int>> |
    And I see no other errors

  Scenario: Asserting traverse should throw error on function not returning Applicative
    Given I have the following code
      """
      $function = function (string $a): int {
        return random_int(-1, 1);
      };
      $traversable = new FakeTraversable(str_shuffle('string'));
      $traversable->traverse($function);
      """
    When I run psalm
    Then I see these errors
      | Type  | Message |
      | InvalidArgument |  Argument 1 of FakeTraversable::traverse expects callable(string):FunctionalPHP\FantasyLand\Applicative<mixed>, impure-Closure(string):int provided |
    And I see no other errors

  Scenario: Asserting traverse should throw error on function not accepting Traversable type
    Given I have the following code
      """
      $function = function (int $a): f\Applicative {
        return new FakeMonad(random_int(-1, 1));
      };
      $traversable = new FakeTraversable(str_shuffle('string'));
      $traversable->traverse($function);
      """
    When I run psalm
    Then I see these errors
      | Type  | Message |
      | InvalidScalarArgument | Type string should be a subtype of int |
    And I see no other errors