Feature: emptyy
  In order to use emptyy
  As a Psalm user
  I need Psalm to typecheck function

  Background:
    Given I have the default psalm configuration
    And I have the default code preamble

  Scenario: Asserting psalm recognizes return type
    Given I have the following code
      """
      /**
       * @implements f\Monoid<string>
       */
      class String_ implements f\Monoid
      {
          public $value;
          final public function __construct(string $value)
          {
              $this->value = $value;
          }
          public static function mempty()
          {
              return new static('');
          }
          public function concat(f\Semigroup $value) : f\Semigroup
          {
              if ($value instanceof self) {
                  return new self($this->value . $value->value);
              }

              throw new \RuntimeException('error');
          }
      }
      $dummy = new String_('foo');
      /** @psalm-trace $check */
      $check = String_::mempty();
      /** @psalm-trace $result */
      $result = f\emptyy($dummy);
      """
    When I run psalm
    Then I see these errors
      | Type  | Message |
      | Trace | $check: FunctionalPHP\FantasyLand\Monoid<string> |
      | Trace | $result: FunctionalPHP\FantasyLand\Monoid<string> |
    And I see no other errors
