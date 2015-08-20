<?php namespace BapCat\Values;

use BapCat\Interfaces\Values\Value;

use InvalidArgumentException;

/**
 * Represents an IP address
 * 
 * @author    Corey Frenette
 * @copyright Copyright (c) 2015, BapCat
 */
class Ip extends Value {
  /**
   * The raw IP address
   * 
   * @var  string
   */
  private $raw;
  
  /**
   * The binary IP address
   * 
   * @var  string
   */
  private $bin;
  
  /**
   * Constructor
   * 
   * @param  string  $ip  The raw IP to wrap 
   */
  public function __construct($ip) {
    $bin = @inet_pton($ip);
    
    if($bin === false) {
      throw new InvalidArgumentException("Expected IP, but got [$ip] instead");
    }
    
    $this->raw = $ip;
    $this->bin = $bin;
  }
  
  /**
   * Converts this object to a string
   * 
   * @return  string  A string representation of this object
   */
  public function __toString() {
    return $this->asReadable();
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
   * Gets the binary representation of this IP
   * 
   * @return  string  The binary representation of this object
   */
  public function asBinary() {
    return $this->bin;
  }
  
  /**
   * Gets the human-readable dotted decimal representation of this IP
   * 
   * @return  string  The human-readable representation of this object
   */
  public function asReadable() {
    return $this->raw;
  }
}
