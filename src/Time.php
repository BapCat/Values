<?php namespace BapCat\Values;

use BapCat\Interfaces\Values\Value;

use InvalidArgumentException;

class Time extends Value {
  private $hour = 0;
  private $min  = 0;
  private $sec  = 0;
  
  public function __construct($time) {
    parent::__construct($time);
  }
  
  protected function validate($time) {
    //TODO
  }
  
  
}
