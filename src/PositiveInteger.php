<?php namespace BapCat\Values;

use BapCat\Interfaces\Values\Value;

use InvalidArgumentException;

class PositiveInteger extends Value {
  private $raw;
  
  public function __construct($positive) {
    $this->validate($positive);
    $this->raw = $positive;
  }
  
  private function validate($positive) {
    if(filter_var($positive, FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]]) === false) {
      throw new InvalidArgumentException("Expected a positive integer, but got [$positive] instead");
    }
  }
  
  protected function getRaw() {
    return $this->raw;
  }
}
