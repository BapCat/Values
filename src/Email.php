<?php namespace BapCat\Values;

use BapCat\Interfaces\Values\Value;

use InvalidArgumentException;

class Email extends Value {
  private $local  = null;
  private $domain = null;
  
  public function __construct(String $email) {
    if(filter_var($email->value(), FILTER_VALIDATE_EMAIL) === false) {
      throw new InvalidArgumentException("Expected email address, but got [$email] instead");
    }
    
    parent::__construct($email);
    
    $parts = explode('@', $this->value());
    $this->domain = new String(array_pop($parts));
    $this->local  = new String(implode('@', $parts));
  }
  
  public function __toString() {
    return (string)$this->value();
  }
  
  public function getLocal() {
    return $this->local;
  }
  
  public function getDomain() {
    return $this->domain;
  }
}
