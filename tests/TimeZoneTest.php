<?php

use BapCat\Values\TimeZone;

class TimeZoneTest extends PHPUnit_Framework_TestCase {
  public function testInvalid() {
    $this->setExpectedException('InvalidArgumentException');
    
    $value = 'IDont/Exist';
    $tz = new TimeZone($value);
  }
  
  public function testValid() {
    $value = 'America/Halifax';
    $tz = new TimeZone($value);
    $this->assertEquals($value, (string)$tz);
    $this->assertEquals($value, $tz->getName());
    $this->assertEquals(-3, $tz->getOffset() / 3600);
  }
}
