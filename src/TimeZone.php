<?php namespace BapCat\Values;

use BapCat\Interfaces\Values\Value;

use DateTimeZone;
use DateTime;

use InvalidArgumentException;

class TimeZone extends Value {
  private $name;
  private $offset;
  
  public function __construct($zone) {
    $this->validate($zone);
    
    $this->name = new Text($zone);
    
    $timezone = new DateTimeZone($zone);
    $this->offset = $timezone->getOffset(new DateTime());
  }
  
  private function validate($zone) {
    if(!in_array($zone, DateTimeZone::listIdentifiers())) {
      throw new InvalidArgumentException("Expected timezone, but got [$zone] instead");
    }
  }
  
  public function __toString() {
    return (string)$this->name;
  }
  
  public function getName() {
    return $this->name;
  }
  
  public function getOffset() {
    return $this->offset;
  }
}
