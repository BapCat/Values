<?php namespace BapCat\Values;

use BapCat\Interfaces\Values\Value;

use InvalidArgumentException;

/**
 * Represents text
 * 
 * @author    Corey Frenette
 * @copyright Copyright (c) 2015, BapCat
 */
class Text extends Value {
  /**
   * The raw string
   * 
   * @var  string
   */
  private $raw;
  
  /**
   * Returns an array of Text objects build from an array of strings
   * 
   * @param   array<string>  $strings  The strings from which to build Text objects
   * 
   * @return  array<Text>  The Text objects built from the array of strings
   */
  public static function fromArray(array $strings) {
    return array_map(function($string) {
      return new static($string);
    }, $strings);
  }
  
  /**
   * Constructor
   * 
   * @param  string  $string  The raw text in string form
   */
  public function __construct($string) {
    $this->validate($string);
    $this->raw = $string;
  }
  
  /**
   * Ensures the string passed in is valid
   * 
   * @throws  InvalidArgumentException  If the value is not a valid string
   * 
   * @param  string  $string  The value to validate
   */
  private function validate($string) {
    if(!is_string($string)) {
      throw new InvalidArgumentException("Expected string, but got [$string] instead");
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
   * Gets the raw value this object wraps
   * 
   * @return  string  The raw value this object wraps
   */
  protected function getRaw() {
    return $this->raw;
  }
  
  /*
   * Properties
   */
  
  /**
   * Gets the length of this text
   * 
   * @return  integer  The length of this text
   */
  protected function getLength() {
    return strlen($this->raw);
  }
  
  /**
   * Gets whether or not this text is empty
   * 
   * @return  boolean  True if length is 0, false otherwise
   */
  protected function getIsEmpty() {
    return $this->length == 0;
  }
  
  /*
   * Methods
   */
  
  /**
   * Checks if two Text objects are equal
   * 
   * @return  boolean  True if the objects are equal, false otherwise
   */
  public function equals(Text $other = null) {
    if($other === null) {
      return false;
    }
    
    return $this->raw == (string)$other;
  }
  
  /**
   * Checks if this Text object starts with another Text object
   * 
   * @param   Text  $other  The other text object
   * 
   * @return  boolean  True if this Text object starts with the other Text object, false otherwise
   */
  public function startsWith(Text $other) {
    return strpos($this->raw, (string)$other) === 0;
  }
  
  /**
   * Checks if this Text object ends with another Text object
   * 
   * @param   Text  $other  The other text object
   * 
   * @return  boolean  True if this Text object ends with the other Text object, false otherwise
   */
  public function endsWith(Text $other) {
    return strrpos($this->raw, (string)$other, -$other->length) === ($this->length - $other->length);
  }
  
  /**
   * Checks if this Text object contains another Text object
   * 
   * @param   Text  $other  The other text object
   * 
   * @return  boolean  True if this Text object contains the other Text object, false otherwise
   */
  public function contains(Text $other) {
    return strpos($this->raw, (string)$other) !== false;
  }
  
  /**
   * Checks if this Text object matches a regular expression
   * 
   * @param   Regex  $regex  The regex
   * 
   * @return  boolean  True if this Text object matches the regular expression, false otherwise
   */
  public function matches(Regex $regex) {
    return $regex->check($this);
  }
  
  /**
   * Get part of this Text object
   * 
   * @param   integer  $start   Where in the string to start
   * @param   integer  $length  (optional) The number of characters to get
   * 
   * @return  Text  A new Text object containing part of this Text object
   */
  public function substring($start, $length = null) {
    if($length === null) {
      return new static(substr($this->raw, $start));
    }
    
    return new static(substr($this->raw, $start, $length));
  }
  
  /**
   * Concatenate two Text objects together
   * 
   * @param   Text  $other  The other text object
   * 
   * @return  Text  A new Text object containing both Text objects concatenated together
   */
  public function concat(Text $other) {
    return new static($this->raw . (string)$other);
  }
  
  /**
   * Trims this Text object
   * 
   * @return  Text  A new Text object containing a trimmed version of this Text object
   */
  public function trim() {
    return new static(trim($this->raw));
  }
  
  /**
   * Pads this text object with spaces
   * 
   * @param   integer  $length  The length to pad this Text object to
   * 
   * @return  Text  A new Text object containing this Text object, padded to the correct length
   */
  public function pad($length) {
    return new static(str_pad($this->raw, $length));
  }
  
  /**
   * Converts this Text object to upper case
   * 
   * @return  Text  A new Text object containing this Text object, converted to upper case
   */
  public function toUpperCase() {
    return new static(strtoupper($this->raw));
  }
  
  /**
   * Converts this Text object to lower case
   * 
   * @return  Text  A new Text object containing this Text object, converted to lower case
   */
  public function toLowerCase() {
    return new static(strtolower($this->raw));
  }
  
  /**
   * Replaces parts of this Text object based on a search and replace
   * 
   * @param   Text  $search   The text to find
   * @param   Text  $replace  The text with which to replace the found text
   * 
   * @return  Text  A new Text object containing this Text object, with all search text replaced
   */
  public function replace(Text $search, Text $replace) {
    return new static(str_replace((string)$search, (string)$replace, $this->raw));
  }
  
  /**
   * Splits this Text object based on another Text object
   * 
   * @param   Text  $delimiter  The Text object to split on
   * 
   * @return  Text  A new Text object containing this Text object, split by the delimiter
   */
  public function split(Text $delimiter) {
    return static::fromArray(explode((string)$delimiter, $this->raw));
  }
}
