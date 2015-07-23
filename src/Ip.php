<?php namespace BapCat\Values;

use BapCat\Interfaces\Values\Value;

use InvalidArgumentException;

class Ip extends Value {
  private $raw;
  
  public function __construct($ip) {
    $raw = @inet_pton($ip);
    
    if($raw === false) {
      throw new InvalidArgumentException("Expected IP, but got [$ip] instead");
    }
    
    $this->raw = $raw;
  }
  
  public function __toString() {
    return $this->asReadable();
  }
  
  protected function getRaw() {
    return (string)$this;
  }
  
  public function asBinary() {
    return $this->raw;
  }
  
  public function asReadable() {
    return inet_ntop($this->raw);
  }
}
