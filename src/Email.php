<?php namespace BapCat\Values;

use BapCat\Interfaces\Values\Value;

use InvalidArgumentException;

class Email extends Value {
  private $local;
  private $domain;
  
  public function __construct($email) {
    $this->validate($email);
    $parts = explode('@', $email);
    $this->domain = new String(array_pop($parts));
    $this->local  = new String(implode('@', $parts));
  }
  
  private function validate($email) {
    if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
      throw new InvalidArgumentException("Expected email address, but got [$email] instead");
    }
  }
  
  public function __toString() {
    return (string)$this->local . '@' . (string)$this->domain;
  }
  
  protected function getLocalPart() {
    return $this->local;
  }
  
  protected function getDomainPart() {
    return $this->domain;
  }
}
