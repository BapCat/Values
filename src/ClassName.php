<?php namespace BapCat\Values;

use BapCat\Interfaces\Values\Value;

use InvalidArgumentException;
use ReflectionClass;
use ReflectionException;

/**
 * Represents a class
 * 
 * @author    Corey Frenette
 * @copyright Copyright (c) 2015, BapCat
 */
class ClassName extends Value {
  /**
   * The name of the class
   * 
   * @var  string
   */
  private $name;
  
  /**
   * Constructor
   * 
   * @param  string  $name  The raw class name to wrap 
   */
  public function __construct($name) {
    $this->validate($name);
    
    $this->name = $name;
  }
  
  /**
   * Ensures the name passed in belongs to a valid class
   * 
   * @throws  InvalidArgumentException  If the value is not a valid class
   * 
   * @param  string  $name  The value to validate
   */
  private function validate($name) {
    try {
      new ReflectionClass($name);
    } catch(ReflectionException $ex) {
      throw new InvalidArgumentException("Expected class name, but got [$name] instead");
    }
  }
  
  /**
   * Converts this object to a string
   * 
   * @return  string  A string representation of this object
   */
  public function __toString() {
    return $this->name;
  }
  
  /**
   * Converts this object to a json encodable-form
   * 
   * @return  string  A representation of this object suitable for encoding
   */
  public function jsonSerialize() {
    return $this->raw;
  }
  
  /**
   * Gets the raw value this object wraps
   * 
   * @return  boolean  The raw value this object wraps
   */
  protected function getRaw() {
    return $this->name;
  }
  
  /**
   * Creates a ReflectionClass for this class
   * 
   * @return  ReflectionClass  An instance of ReflectionClass for this class
   */
  public function reflect() {
    return new ReflectionClass($this->name);
  }
}
