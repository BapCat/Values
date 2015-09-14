<?php namespace BapCat\Values;

use BapCat\Interfaces\Values\Value;

use InvalidArgumentException;

/**
 * Represents a password
 * 
 * @author    Corey Frenette
 * @copyright Copyright (c) 2015, BapCat
 */
class Password extends Value {
  /**
   * The raw password
   * 
   * @var  string
   */
  private $raw;
  
  /**
   * Constructor
   * 
   * @param  string  $password  The raw password to wrap 
   */
  public function __construct($password) {
    $this->validate($password);
    
    $this->raw = $password;
  }
  
  /**
   * Ensures the password is valid
   * 
   * @throws  InvalidArgumentException  If the password is not valid
   * 
   * @param  string  $name  The password to validate
   */
  private function validate($password) {
    if(strlen($password) < 8) {
      throw new InvalidArgumentException("The password must be at least 8 characters long");
    }
    
    if(strlen($password) > 56) {
      throw new InvalidArgumentException("The password must be no more than 56 characters long");
    }
  }
  
  /**
   * Converts this object to a string
   * 
   * @return  string  A string representation of this object
   */
  public function __toString() {
    return $this->raw;
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
    return $this->raw;
  }
}
