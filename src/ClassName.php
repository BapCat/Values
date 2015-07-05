<?php namespace BapCat\Values;

use InvalidArgumentException;
use ReflectionClass;
use ReflectionException;

class ClassName {
  private $name;
  
  public function __construct($name) {
    $this->validate($name);
    
    $this->name = $name;
  }
  
  public function __toString() {
    return $this->name;
  }
  
  private function validate($name) {
    try {
      new ReflectionClass($name);
    } catch(ReflectionException $ex) {
      throw new InvalidArgumentException("Expected class name, but got [$name] instead");
    }
  }
  
  public function reflect() {
    return new ReflectionClass($this->name);
  }
}
