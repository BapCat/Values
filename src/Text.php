<?php namespace BapCat\Values;

use BapCat\Interfaces\Values\Value;

use InvalidArgumentException;

class Text extends Value {
  private $raw;
  
  public static function fromArray(array $strings) {
    return array_map(function($string) {
      return new static($string);
    }, $strings);
  }
  
  public function __construct($string) {
    $this->validate($string);
    $this->raw = $string;
  }
  
  private function validate($string) {
    if(!is_string($string)) {
      throw new InvalidArgumentException("Expected string, but got [$string] instead");
    }
  }
  
  public function __toString() {
    return $this->raw;
  }
  
  /*
   * Properties
   */
  
  public function length() {
    return strlen($this->raw);
  }
  
  public function isEmpty() {
    return $this->length() == 0;
  }
  
  public function equals(Text $other = null) {
    if($other === null) {
      return false;
    }
    
    return $this->raw == (string)$other;
  }
  
  public function startsWith(Text $other) {
    return strpos($this->raw, (string)$other) === 0;
  }
  
  public function endsWith(Text $other) {
    return strrpos($this->raw, (string)$other, -$other->length()) === ($this->length() - $other->length());
  }
  
  public function contains(Text $other) {
    return strpos($this->raw, (string)$other) !== false;
  }
  
  public function matches(Regex $regex) {
    return $regex->check($this);
  }
  
  /*
   * Methods
   */
  
  public function substring($start, $length = null) {
    if($length === null) {
      return new static(substr($this->raw, $start));
    }
    
    return new static(substr($this->raw, $start, $length));
  }
  
  public function concat(Text $other) {
    return new static($this->raw . (string)$other);
  }
  
  public function trim() {
    return new static(trim($this->raw));
  }
  
  public function pad($length) {
    return new static(str_pad($this->raw, $length));
  }
  
  public function toUpperCase() {
    return new static(strtoupper($this->raw));
  }
  
  public function toLowerCase() {
    return new static(strtolower($this->raw));
  }
  
  public function replace(Text $search, Text $replace) {
    return new static(str_replace((string)$search, (string)$replace, $this->raw));
  }
  
  public function split(Text $delimiter) {
    return static::fromArray(explode((string)$delimiter, $this->raw));
  }
}
