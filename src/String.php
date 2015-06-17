<?php namespace BapCat\Values;

use BapCat\Interfaces\Values\Value;

use InvalidArgumentException;

class String extends Value {
  public function __construct($string) {
    if(!is_string($string)) {
      throw new InvalidArgumentException("Expected string, but got [$string] instead");
    }
    
    parent::__construct($string);
  }
  
  public function __toString() {
    return $this->value();
  }
  
  /*
   * Properties
   */
  
  public function length() {
    return strlen($this->value());
  }
  
  public function isEmpty() {
    return $this->length() == 0;
  }
  
  public function equals(String $other) {
    return $this->value() == $other->value();
  }
  
  public function startsWith(String $other) {
    return strpos($this->value(), $other->value()) === 0;
  }
  
  public function endsWith(String $other) {
    return strrpos($this->value(), $other->value(), -$other->length()) === ($this->length() - $other->length());
  }
  
  public function contains(String $other) {
    return strpos($this->value(), $other->value()) !== false;
  }
  
  /*
   * Methods
   */
  
  public function substring($start, $length = null) {
    if($length === null) {
      return new static(substr($this->value(), $start));
    }
    
    return new static(substr($this->value(), $start, $length));
  }
  
  public function trim() {
    return new static(trim($this->value()));
  }
  
  public function pad($length) {
    return new static(str_pad($this->value(), $length));
  }
  
  public function toUpperCase() {
    return new static(strtoupper($this->value()));
  }
  
  public function toLowerCase() {
    return new static(strtolower($this->value()));
  }
}
