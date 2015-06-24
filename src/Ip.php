<?php namespace BapCat\Values;

use BapCat\Interfaces\Values\Value;

use InvalidArgumentException;

class Ip extends Value {
  private $dec;
  private $octets  = [0, 0, 0, 0];
  private $class   = null;
  private $local   = false;
  private $private = false;
  
  public function __construct($ip) {
    $this->validate($ip);
    
    $this->dec = ip2long($ip);
    
    $octets = array_map(function($val) {
      if($val < 0) {
        return $val + 256;
      }
      
      return $val;
    }, [
      ($this->dec & 0xFF000000) >> 24,
      ($this->dec & 0x00FF0000) >> 16,
      ($this->dec & 0x0000FF00) >>  8,
      ($this->dec & 0x000000FF) >>  0,
    ]);
    
    $this->octets = $octets;
    
    if($octets[0] >= 0xF0) {
      $this->class = IpClass::E();
    } elseif($octets[0] >= 0xE0) {
      $this->class = IpClass::D();
    } elseif($octets[0] >= 0xC0) {
      $this->class = IpClass::C();
      
      if($octets[1] == 0xA8) {
        $this->private = true;
      }
    } elseif($octets[0] >= 0x80) {
      $this->class = IpClass::B();
      
      if($octets[1] == 0x10) {
        $this->private = true;
      }
    } else {
      $this->class = IpClass::A();
      
      if($octets[0] == 0x7F) {
        $this->local   = true;
        $this->private = true;
      } elseif($octets[0] == 0x0A) {
        $this->private = true;
      }
    }
  }
  
  private function validate($ip) {
    if(filter_var($ip, FILTER_VALIDATE_IP) === false) {
      throw new InvalidArgumentException("Expected IP, but got [$ip] instead");
    }
  }
  
  public function __toString() {
    return $this->asDottedDecimal();
  }
  
  public function getOctet($index) {
    if($index < 0 || $index > 3) {
      throw new InvalidArgumentException("Index [$index] is out of bounds [0, 3]");
    }
    
    return $this->octets[$index];
  }
  
  public function getClass() {
    return $this->class;
  }
  
  public function isLocal() {
    return $this->local;
  }
  
  public function isPrivate() {
    return $this->private;
  }
  
  public function asInteger() {
    return $this->dec;
  }
  
  public function asDottedDecimal() {
    return long2ip($this->dec);
  }
}
