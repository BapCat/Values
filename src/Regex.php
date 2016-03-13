<?php namespace BapCat\Values;

use BapCat\Interfaces\Values\Value;

use InvalidArgumentException;

/**
 * Represents a regular expression
 * 
 * @author    Corey Frenette
 * @copyright Copyright (c) 2015, BapCat
 */
class Regex extends Value {
  /**
   * The raw regular expression string
   * 
   * @var  string
   */
  private $raw;
  
  /**
   * Constructor
   * 
   * @param  string  $regex  The raw regex in string form
   */
  public function __construct($regex) {
    $this->validate($regex);
    $this->raw = $regex;
  }
  
  /**
   * Ensures the regex passed in is valid
   * 
   * @throws  InvalidArgumentException  If the value is not a valid regex
   * 
   * @param  string  $regex  The value to validate
   */
  private function validate($regex) {
    if(@preg_match($regex, null) === false) {
      throw new InvalidArgumentException("Expected regex, but got [$regex] instead");
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
  
  /**
   * Checks if a given Text object matches this regular expression
   * 
   * @param   Text  $text  The text to check against this regular expression
   * 
   * @return  boolean  True if the text matches this regular expression, false otherwise
   */
  public function check(Text $text) {
    return preg_match($this->raw, (string)$text) === 1;
  }
  
  /**
   * Extracts capture groups from a given Text object
   * 
   * @param   Text  $text  The text to capture from
   * 
   * @return  array<Text>  An array of new Text objects based on the capturing groups of this regular expression
   */
  public function capture(Text $text) {
    $result = preg_match_all($this->raw, (string)$text, $matches, PREG_SET_ORDER);
    
    foreach($matches as &$match) {
      array_shift($match);
      
      $match = $text->fromArray($match);
    }
    
    return $matches;
  }
  
  /**
   * Splits a given Text object based on this regular expression
   * 
   * @param   Text  $text  The text to split
   * 
   * @return  array<Text>  An array of new Text objects based on the given Text, split by this regular expression
   */
  public function split(Text $text) {
    return $text->fromArray(preg_split($this->raw, (string)$text));
  }
  
  /**
   * Replaces parts of a Text object based on a search and replace via this regex
   * 
   * @param   Text  $text     The text to replace
   * @param   Text  $replace  The text with which to replace the found text
   * 
   * @return  Text  A new Text object with all search text replaced
   */
  public function replace(Text $text, Text $replace) {
    return new Text(preg_replace($this->raw, $replace->raw, $text->raw));
  }
}
