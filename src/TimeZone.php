<?php namespace BapCat\Values;

use BapCat\Interfaces\Values\Value;

use InvalidArgumentException;

class TimeZone extends Value {
  private $name = null;
  private $offset = 0;
  
  public function __construct($zone) {
    parent::__construct($zone);
    
    $this->name = new String($zone);
    
    $timezone = new DateTimeZone($zone);
    $this->offset = $timezone->getOffset(new DateTime());
  }
  
  protected function validate($zone) {
    if(!in_array($zone, DateTimeZone::listIdentifiers())) {
      throw new InvalidArgumentException("Expected timezone, but got [$zone] instead");
    }
  }
  
  public function getName() {
    return $this->name;
  }
  
  public function getOffset() {
    return $this->offset;
  }
}
