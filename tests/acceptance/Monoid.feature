Feature: Monoid
  In order to use Monoid
  As a Psalm user
  I need Psalm to typecheck methods

  Background:
    Given I have the default psalm configuration
    And I have the default code preamble

  Scenario: Asserting mempty :: Monoid m => () -> m
    Given I have the following code
      """
      /** @psalm-trace $monoid */
      $monoid = FakeMonoid::mempty();
      """
    When I run psalm
    Then I see these errors
      | Type  | Message |
      | Trace | $monoid: FunctionalPHP\FantasyLand\Monoid |
    And I see no other errors

  Scenario: Asserting concat :: Semigroup a => a ~> a -> a
    Given I have the following code
      """
      /**
       * @template-implements f\Semigroup<string>
       */
      class StringSemigroup implements f\Semigroup
      {
          /** @psalm-suppress InvalidReturnType */
          public function concat(f\Semigroup $value): f\Semigroup
          {
          }
      }
      $monoid = new FakeMonoid(str_shuffle('string'));
      /** @psalm-trace $value */
      $value = $monoid->concat(new StringSemigroup());
      """
    When I run psalm
    Then I see these errors
      | Type  | Message |
      | Trace | $value: FunctionalPHP\FantasyLand\Semigroup<string> |
    And I see no other errors

  Scenario: Asserting concat() fails with different semigroup
    Given I have the following code
      """
      /**
       * @template-implements f\Semigroup<string>
       */
      class StringSemigroup implements f\Semigroup
      {
          /** @psalm-suppress InvalidReturnType */
          public function concat(f\Semigroup $value): f\Semigroup
          {
          }
      }
      $monoid = new FakeMonoid(random_int(-1, 1));
      $monoid->concat(new StringSemigroup());
      """
    When I run psalm
    Then I see these errors
      | Type  | Message |
      | InvalidScalarArgument | Argument 1 of FakeMonoid::concat expects FunctionalPHP\FantasyLand\Semigroup<int>, StringSemigroup provided |
    And I see no other errors