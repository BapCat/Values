<?php namespace BapCat\Values;

use BapCat\Interfaces\Values\Value;

use InvalidArgumentException;

class Domain extends Value {
  private $domain;
  private $parent;
  
  public function __construct($domain, Domain $parent = null) {
    $this->validate($domain);
    $this->domain = $domain;
    $this->parent = $parent;
  }
  
  private function validate($domain) {
    //@TODO
  }
  
  public function __toString() {
    $full = $this->domain;
    
    if($this->parent !== null) {
      $full .= '.' . (string)$this->parent;
    }
    
    return $full;
  }
  
  protected function getRaw() {
    return (string)$this;
  }
}
