Feature: compose
  In order to use compose
  As a Psalm user
  I need Psalm to typecheck function

  Background:
    Given I have the default psalm configuration
    And I have the default code preamble

  Scenario: Asserting psalm recognizes return type
    Given I have the following code
      """
      $f1 = function (string $a): int {
          return strlen($a);
      };

      $f2 = function (string $a): string {
          return $a . 'bar';
      };

      /** @psalm-trace $function */
      $function = f\compose($f1, $f2);
      """
    When I run psalm
    Then I see these errors
      | Type  | Message |
      | Trace | $function: callable(string):int |
    And I see no other errors
