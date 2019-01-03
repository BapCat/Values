<?php declare(strict_types = 1); namespace BapCat\Values;

use InvalidArgumentException;

use function is_string;
use function strlen;

/**
 * Represents text
 *
 * @property-read  string  $raw
 * @property-read  int     $length;
 * @property-read  bool    $is_empty;
 *
 * @author    Corey Frenette
 * @copyright Copyright (c) 2019, BapCat
 */
class Text extends Value {
  /** @var  string  $raw  The raw string */
  private $raw;

  /**
   * Returns an array of Text objects build from an array of strings
   *
   * @param  string[]  $strings  The strings from which to build Text objects
   *
   * @return  Text[]  The Text objects built from the array of strings
   */
  public static function fromArray(array $strings): array {
    return array_map(function($string) {
      return new static($string);
    }, $strings);
  }

  /**
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
  private function validate($string): void {
    if(!is_string($string)) {
      throw new InvalidArgumentException('Expected string, but got [' . var_export($string, true) . '] instead');
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
  public function jsonSerialize(): string {
    return $this->raw;
  }

  /**
   * Gets the raw value this object wraps
   *
   * @return  string  The raw value this object wraps
   */
  protected function getRaw(): string {
    return $this->raw;
  }

  /*
   * Properties
   */

  /**
   * Gets the length of this text
   *
   * @return  int  The length of this text
   */
  protected function getLength(): int {
    return strlen($this->raw);
  }

  /**
   * Gets whether or not this text is empty
   *
   * @return  bool  True if length is 0, false otherwise
   */
  protected function getIsEmpty(): bool {
    return $this->length === 0;
  }

  /*
   * Methods
   */

  /**
   * Checks if two Text objects are equal
   *
   * @param  Text|null  $other
   *
   * @return  bool  True if the objects are equal, false otherwise
   */
  public function equals(?Text $other = null): bool {
    if($other === null) {
      return false;
    }

    return $this->raw === (string)$other;
  }

  /**
   * Checks if this Text object starts with another Text object
   *
   * @param  Text  $other  The other text object
   *
   * @return  bool  True if this Text object starts with the other Text object, false otherwise
   */
  public function startsWith(Text $other): bool {
    return strpos($this->raw, (string)$other) === 0;
  }

  /**
   * Checks if this Text object ends with another Text object
   *
   * @param  Text  $other  The other text object
   *
   * @return  bool  True if this Text object ends with the other Text object, false otherwise
   */
  public function endsWith(Text $other): bool {
    return strrpos($this->raw, (string)$other, -$other->length) === ($this->length - $other->length);
  }

  /**
   * Checks if this Text object contains another Text object
   *
   * @param  Text  $other  The other text object
   *
   * @return  bool  True if this Text object contains the other Text object, false otherwise
   */
  public function contains(Text $other): bool {
    return strpos($this->raw, (string)$other) !== false;
  }

  /**
   * Checks if this Text object matches a regular expression
   *
   * @param  Regex  $regex  The regex
   *
   * @return  bool  True if this Text object matches the regular expression, false otherwise
   */
  public function matches(Regex $regex): bool {
    return $regex->check($this);
  }

  /**
   * Get part of this Text object
   *
   * @param  int       $start   Where in the string to start
   * @param  int|null  $length  (optional) The number of characters to get
   *
   * @return  Text  A new Text object containing part of this Text object
   */
  public function substring(int $start, ?int $length = null): Text {
    if($length === null) {
      return new static(substr($this->raw, $start));
    }

    return new static(substr($this->raw, $start, $length));
  }

  /**
   * Concatenate two Text objects together
   *
   * @param  Text  $other  The other text object
   *
   * @return  Text  A new Text object containing both Text objects concatenated together
   */
  public function concat(Text $other): Text {
    return new static($this->raw . $other);
  }

  /**
   * Trims this Text object
   *
   * @return  Text  A new Text object containing a trimmed version of this Text object
   */
  public function trim(): Text {
    return new static(trim($this->raw));
  }

  /**
   * Pads this text object with spaces
   *
   * @param  int  $length  The length to pad this Text object to
   *
   * @return  Text  A new Text object containing this Text object, padded to the correct length
   */
  public function pad(int $length): Text {
    return new static(str_pad($this->raw, $length));
  }

  /**
   * Converts this Text object to upper case
   *
   * @return  Text  A new Text object containing this Text object, converted to upper case
   */
  public function toUpperCase(): Text {
    return new static(strtoupper($this->raw));
  }

  /**
   * Converts this Text object to lower case
   *
   * @return  Text  A new Text object containing this Text object, converted to lower case
   */
  public function toLowerCase(): Text {
    return new static(strtolower($this->raw));
  }

  /**
   * Replaces parts of this Text object based on a search and replace
   *
   * @param  Text  $search   The text to find
   * @param  Text  $replace  The text with which to replace the found text
   *
   * @return  Text  A new Text object containing this Text object, with all search text replaced
   */
  public function replace(Text $search, Text $replace): Text {
    return new static(str_replace((string)$search, (string)$replace, $this->raw));
  }

  /**
   * Replaces parts of this Text object based on a search and replace via a regex
   *
   * @param  Regex  $search   The regex to match
   * @param  Text   $replace  The text with which to replace the found text
   *
   * @return  Text  A new Text object containing this Text object, with all search text replaced
   */
  public function replaceByRegex(Regex $search, Text $replace): Text {
    return $search->replace($this, $replace);
  }

  /**
   * Splits this Text object based on another Text object
   *
   * @param  Text  $delimiter  The Text object to split on
   *
   * @return  Text[]  A new Text object containing this Text object, split by the delimiter
   */
  public function split(Text $delimiter): array {
    return static::fromArray(explode((string)$delimiter, $this->raw));
  }
}
