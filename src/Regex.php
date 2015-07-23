<?php namespace BapCat\Values;

use BapCat\Interfaces\Values\Value;

use InvalidArgumentException;

class Regex extends Value {
  private $raw;
  
  public function __construct($regex) {
    $this->validate($regex);
    $this->raw = $regex;
  }
  
  private function validate($regex) {
    if(@preg_match($regex, null) === false) {
      throw new InvalidArgumentException("Expected regex, but got [$regex] instead");
    }
  }
  
  public function __toString() {
    return $this->raw;
  }
  
  protected function getRaw() {
    return (string)$this;
  }
  
  public function check(Text $string) {
    return preg_match($this->raw, (string)$string) === 1;
  }
  
  public function capture(Text $string) {
    $result = preg_match_all($this->raw, (string)$string, $matches, PREG_SET_ORDER);
    
    foreach($matches as &$match) {
      array_shift($match);
      
      $match = $string->fromArray($match);
    }
    
    return $matches;
  }
  
  public function split(Text $string) {
    return $string->fromArray(preg_split($this->raw, (string)$string));
  }
}
