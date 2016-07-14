<?php namespace BapCat\Values;

use BapCat\Interfaces\Values\Value;

use InvalidArgumentException;

/**
 * Represents a timestamp
 * 
 * @author    Corey Frenette
 * @copyright Copyright (c) 2015, BapCat
 */
class Timestamp extends Value {
  /**
   * The timestamp
   * 
   * @var  int|float
   */
  private $raw;
  
  /**
   * Constructor
   * 
   * @param  int|float  $timestamp  The timestamp to wrap
   */
  public function __construct($timestamp) {
    if(is_numeric($timestamp)) {
      if(is_int($timestamp)) {
        $this->raw = (int)$timestamp;
        return;
      }
      
      if(is_float($timestamp)) {
        $this->raw = (float)$timestamp;
        return;
      }
    }
    
    throw new InvalidArgumentException("Expected timestamp, but got [" . var_export($timestamp, true) . "] instead");
  }
  
  /**
   * Converts this object to a string
   * 
   * @return  string  A string representation of this object
   */
  public function __toString() {
    return (string)$this->raw;
  }
  
  /**
   * Converts this object to a json encodable-form
   * 
   * @return  string  A representation of this object suitable for encoding
   */
  public function jsonSerialize() {
    return $this->raw;
  }
  
  /**
   * Gets the raw value this object wraps
   * 
   * @return  int|float  The raw value this object wraps
   */
  protected function getRaw() {
    return $this->raw;
  }
}
