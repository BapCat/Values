<?php namespace BapCat\Values;

use BapCat\Interfaces\Values\Value;

use InvalidArgumentException;

/**
 * Represents a URL
 *
 * @author    Corey Frenette
 * @copyright Copyright (c) 2015, BapCat
 */
class Url extends Value {
  /**
   * @var string  The raw URL
   */
  private $raw;

  /**
   * Constructor
   *
   * @param  string  $url  The raw URL to wrap
   */
  public function __construct($url) {
    $this->validate($url);
    $this->raw = $url;
  }

  /**
   * Ensures the URL passed in is valid
   * 
   * @throws  InvalidArgumentException  If the value is not a valid URL
   * 
   * @param  string  $url  The value to validate
   */
  private function validate($url) {
    if(filter_var($url, FILTER_VALIDATE_URL) === false) {
      throw new InvalidArgumentException("Expected URL, but got [$url] instead");
    }
  }
  
  /**
   * Converts this object to a string
   * 
   * @return  string  A string representation of this object
   */
  public function __toString() {
      return $this->raw;
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
   * @return  string  The raw value this object wraps
   */
  protected function getRaw() {
    return $this->raw;
  }
}
