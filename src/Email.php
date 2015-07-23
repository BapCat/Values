<?php namespace BapCat\Values;

use BapCat\Interfaces\Values\Value;

use InvalidArgumentException;

class Email extends Value {
  private $local;
  private $domain;
  
  public function __construct($email) {
    $this->validate($email);
    $parts = explode('@', $email);
    
    //TODO: This probably shouldn't be text
    $this->domain = new Text(array_pop($parts));
    $this->local  = new Text(implode('@', $parts));
  }
  
  private function validate($email) {
    if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
      throw new InvalidArgumentException("Expected email address, but got [$email] instead");
    }
  }
  
  public function __toString() {
    return (string)$this->local . '@' . (string)$this->domain;
  }
  
  protected function getRaw() {
    return (string)$this;
  }
  
  protected function getLocalPart() {
    return $this->local;
  }
  
  protected function getDomainPart() {
    return $this->domain;
  }
}
