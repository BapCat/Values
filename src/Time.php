<?php namespace BapCat\Values;

use BapCat\Interfaces\Values\Value;

use InvalidArgumentException;

class Time extends Value {
  public function __construct($time) {
    parent::__construct($time);
  }
  
  protected function validate($time) {
    //TODO
  }
}
