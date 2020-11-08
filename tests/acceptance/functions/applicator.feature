Feature: applicator
  In order to use applicator
  As a Psalm user
  I need Psalm to typecheck function

  Background:
    Given I have the default psalm configuration
    And I have the default code preamble

  Scenario: Asserting psalm recognizes return type
    Given I have the following code
      """
      $ap = function (string $a): int { return strlen($a); };
      /** @psalm-trace $f */
      $f = f\applicator('foo');
      /** @psalm-trace $value */
      $value = $f($ap);
      /** @psalm-trace $finalValue */
      $finalValue = f\applicator('foo', $ap);
      """
    When I run psalm
    Then I see these errors
      | Type            | Message |
      | Trace           | $f: callable(callable(string(foo)):mixed):mixed               |
      | MixedAssignment | Unable to determine the type that $value is being assigned to |
      | Trace           | $value: mixed                                                 |
      | Trace           | $finalValue: int                                              |
    And I see no other errors
