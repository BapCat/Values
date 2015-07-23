<?php namespace BapCat\Values;

use BapCat\Interfaces\Values\Value;

use InvalidArgumentException;

class Time extends Value {
  private $hour;
  private $min;
  private $sec;
  
  public function __construct($hour, $min, $sec) {
    $this->validate($hour, $min, $sec);
    
    $this->hour = $hour;
    $this->min  = $min;
    $this->sec  = $sec;
  }
  
  private function validate($time) {
    if(!is_int($this->hour) || $this->hour < 0 || $this->hour > 23) {
      throw new InvalidArgumentException("Expected hour but got [{$this->hour}]");
    }
    
    if(!is_int($this->min) || $this->min < 0 || $this->min > 59) {
      throw new InvalidArgumentException("Expected minute but got [{$this->$min}]");
    }
    
    if(!is_int($this->sec) || $this->sec < 0 || $this->sec > 59) {
      throw new InvalidArgumentException("Expected second but got [{$this->$sec}]");
    }
  }
  
  public function __toString() {
    return
      str_pad($this->hour, 2, '0', STR_PAD_LEFT) . ':' .
      str_pad($this->min,  2, '0', STR_PAD_LEFT) . ':' .
      str_pad($this->sec,  2, '0', STR_PAD_LEFT)
    ;
  }
  
  protected function getRaw() {
    return (string)$this;
  }
  
  protected function getHour() {
    return $this->hour;
  }
  
  protected function getMinutes() {
    return $this->min;
  }
  
  protected function getSeconds() {
    return $this->sec;
  }
}
