<?php namespace BapCat\Values;

use Eloquent\Enumeration\AbstractMultiton;

final class IpClass extends AbstractMultiton {
  protected static function initializeMembers() {
    new static('A',    8);
    new static('B',   16);
    new static('C',   24);
    new static('D', null);
    new static('E', null);
  }
  
  private $cidr = null;
  
  protected function __construct($class, $cidr) {
    parent::__construct($class);
    $this->cidr = $cidr;
  }
  
  public function cidr() {
    return $this->cidr;
  }
}
