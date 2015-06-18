<?php namespace BapCat\Values;

use BapCat\Interfaces\Values\Value;

use InvalidArgumentException;

class Time extends Value {
  public function __construct($hour, $min, $sec) {
    parent::__construct([$hour, $min, $sec]);
  }
  
  protected function validate($time) {
    list($hour, $min, $sec) = $time;
    
    if(!is_int($hour) || $hour < 0 || $hour > 23) {
      throw new InvalidArgumentException("Expected hour but got [$hour]");
    }
    
    if(!is_int($min) || $min < 0 || $min > 59) {
      throw new InvalidArgumentException("Expected minute but got [$min]");
    }
    
    if(!is_int($sec) || $sec < 0 || $sec > 59) {
      throw new InvalidArgumentException("Expected second but got [$sec]");
    }
  }
  
  /** @override */
  public function value() {
    list($hour, $min, $sec) = parent::value();
    
    return
      str_pad($hour, 2, '0', STR_PAD_LEFT) . ':' .
      str_pad($min,  2, '0', STR_PAD_LEFT) . ':' .
      str_pad($sec,  2, '0', STR_PAD_LEFT)
    ;
  }
  
  public function __toString() {
    return $this->value();
  }
  
  public function getHour() {
    return parent::value()[0];
  }
  
  public function getMinutes() {
    return parent::value()[1];
  }
  
  public function getSeconds() {
    return parent::value()[2];
  }
}
