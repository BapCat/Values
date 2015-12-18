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
   * @var  int
   */
  private $timestamp;
  
  /**
   * Constructor
   * 
   * @param  int  $timestamp  The timestamp to wrap 
   */
  public function __construct($timestamp) {
    $this->validate($timestamp);
    
    $this->timestamp = (int)$timestamp;
  }
  
  /**
   * Ensures the timestamp passed in is valid
   * 
   * @throws  InvalidArgumentException  If the value is not a valid class
   * 
   * @param  int  $timestamp  The value to validate
   */
  private function validate($timestamp) {
    // Gotta check `is_numeric` first because `is_int` errors on non-numbers
    if(!is_numeric($timestamp) || !is_int($timestamp)) {
      throw new InvalidArgumentException("Expected timestamp, but got [$timestamp] instead");
    }
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
   * @return  boolean  The raw value this object wraps
   */
  protected function getRaw() {
    return $this->timestamp;
  }
}
