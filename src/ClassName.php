<?php declare(strict_types = 1); namespace BapCat\Values;

use InvalidArgumentException;
use ReflectionClass;
use ReflectionException;

/**
 * Represents a class
 *
 * @property-read  string  $raw
 *
 * @author    Corey Frenette
 * @copyright Copyright (c) 2019, BapCat
 */
class ClassName extends Value {
  /** @var  string  $name  The name of the class */
  private $name;

  /**
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
   *
   * @return  void
   */
  private function validate($name): void {
    try {
      new ReflectionClass($name);
    } catch(ReflectionException $ex) {
      throw new InvalidArgumentException('Expected class name, but got [' . var_export($name, true) . '] instead');
    }
  }

  /**
   * Converts this object to a string
   *
   * @return  string  A string representation of this object
   */
  public function __toString(): string {
    return $this->name;
  }

  /**
   * Converts this object to a json encodable-form
   *
   * @return  string  A representation of this object suitable for encoding
   */
  public function jsonSerialize(): string {
    return $this->name;
  }

  /**
   * Gets the raw value this object wraps
   *
   * @return  string  The raw value this object wraps
   */
  protected function getRaw(): string {
    return $this->name;
  }

  /**
   * Creates a ReflectionClass for this class
   *
   * @throws  ReflectionException
   *
   * @return  ReflectionClass  An instance of ReflectionClass for this class
   */
  public function reflect(): ReflectionClass {
    return new ReflectionClass($this->name);
  }
}
