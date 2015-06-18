<?php namespace BapCat\Values;

use BapCat\Interfaces\Values\Value;

use InvalidArgumentException;

class Regex extends Value {
  public function __construct($regex) {
    parent::__construct($regex);
  }
  
  protected function validate($regex) {
    if(@preg_match($regex, null) === false) {
      throw new InvalidArgumentException("Expected regex, but got [$regex] instead");
    }
  }
  
  public function __toString() {
    return $this->value();
  }
  
  public function check(String $string) {
    return preg_match($this->value(), $string->value()) === 1;
  }
}
