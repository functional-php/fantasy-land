Feature: push_
  In order to use push_
  As a Psalm user
  I need Psalm to typecheck function

  Background:
    Given I have the default psalm configuration
    And I have the default code preamble

  Scenario: Asserting psalm recognizes return type
    Given I have the following code
      """
      $a = ['a' => 'foo', 'b' => 'bar', 'baz'];
      $b = ['c' => 'foobar', 'foobaz'];

      /** @psalm-trace $value */
      $value = f\push_($a, $b);
      """
    When I run psalm
    Then I see these errors
      | Type  | Message |
      | Trace | $value: array<array-key, string(bar)\|string(baz)\|string(foo)\|string(foobar)\|string(foobaz)> |
    And I see no other errors
