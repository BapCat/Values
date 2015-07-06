<?php namespace BapCat\Values;

use BapCat\Interfaces\Values\Value;

use InvalidArgumentException;

class Boolean extends Value {
  private $raw;
  
  public function __construct($bool) {
    $this->validate($bool);
    $this->raw = $bool;
  }
  
  private function validate($bool) {
    if($bool !== true && $bool !== false) {
      throw new InvalidArgumentException("Expected boolean, but got [$bool] instead");
    }
  }
  
  protected function getRaw() {
    return $this->raw;
  }
}
