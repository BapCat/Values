<?php namespace BapCat\Values;

use BapCat\Interfaces\Values\Value;

use InvalidArgumentException;

/**
 * Represents a class
 * 
 * @author    Corey Frenette
 * @copyright Copyright (c) 2015, BapCat
 */
class Email extends Value {
  /**
   * The local (pre-@) part of the email
   * 
   * @var  Text
   */
  private $local;
  
  /**
   * The domain (post-@) part of the email
   * 
   * @var  Text
   */
  private $domain;
  
  /**
   * The raw email
   * 
   * @var  string
   */
  private $raw;
  
  /**
   * Constructor
   * 
   * @param  string  $name  The raw class name to wrap 
   */
  public function __construct($email) {
    $this->validate($email);
    $this->raw = $email;
    $parts = explode('@', $email);
    
    //TODO: This probably shouldn't be text
    $this->domain = new Text(array_pop($parts));
    $this->local  = new Text(implode('@', $parts));
  }
  
  /**
   * Ensures the valid passed in is a valid email
   * 
   * @throws  InvalidArgumentException  If the value is not a valid email
   * 
   * @param  string  $email  The value to validate
   */
  private function validate($email) {
    if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
      throw new InvalidArgumentException('Expected email address, but got [' . var_export($email, true) . '] instead');
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
   * @return  string  The raw value this object wraps
   */
  protected function getRaw() {
    return $this->raw;
  }
  
  /**
   * Gets the local part of this email
   * 
   * @return  Text  The local part of this email
   */
  protected function getLocalPart() {
    return $this->local;
  }
  
  /**
   * Gets the domain part of this email
   * 
   * @return  Text  The domain part of this email
   */
  protected function getDomainPart() {
    return $this->domain;
  }
}
