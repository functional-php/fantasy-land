Feature: identity
  In order to use identity
  As a Psalm user
  I need Psalm to typecheck function

  Background:
    Given I have the default psalm configuration
    And I have the default code preamble

  Scenario: Asserting psalm recognizes return type
    Given I have the following code
      """
      /** @psalm-trace $result */
      $result = f\identity('foo');
      """
    When I run psalm
    Then I see these errors
      | Type  | Message |
      | Trace | $result: string(foo) |
    And I see no other errors

