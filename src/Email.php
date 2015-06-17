<?php namespace BapCat\Values;

use BapCat\Interfaces\Values\Value;

use InvalidArgumentException;

class Email extends Value {
  private $local  = null;
  private $domain = null;
  
  public function __construct($email) {
    parent::__construct($email);
    
    $parts = explode('@', $this->value());
    $this->domain = new String(array_pop($parts));
    $this->local  = new String(implode('@', $parts));
  }
  
  protected function validate($email) {
    if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
      throw new InvalidArgumentException("Expected email address, but got [$email] instead");
    }
  }
  
  public function __toString() {
    return $this->value();
  }
  
  public function getLocal() {
    return $this->local;
  }
  
  public function getDomain() {
    return $this->domain;
  }
}
