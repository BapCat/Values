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
    if(strlen($password) < $this->validationMinLength()) {
      throw new InvalidArgumentException("The password must be at least {$this->validationMinLength()} characters long");
    }
    
    if(strlen($password) > $this->validationMaxLength()) {
      throw new InvalidArgumentException("The password must be no more than {$this->validationMaxLength()} characters long");
    }
  }
  
  /**
   * Used for validation, the minimum length a password can be
   * 
   * @return  integer  The minimum password length
   */
  protected function validationMinLength() {
    return 8;
  }
  
  /**
   * Used for validation, the maximum length a password can be
   * 
   * @return  integer  The maximum password length
   */
  protected function validationMaxLength() {
    return 56; // BCrypt limitation
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
