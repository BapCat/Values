<?php

use BapCat\Values\Timestamp;

class TimestampTest extends PHPUnit_Framework_TestCase {
  public function testValidTimestamps() {
    new Timestamp(PHP_INT_MAX);
    new Timestamp(0);
    new Timestamp(-PHP_INT_MAX);
  }
  
  public function testNull() {
    $this->setExpectedException(InvalidArgumentException::class);
    new Timestamp(null);
  }
  
  public function testToString() {
    $value = 100;
    $ts = new Timestamp($value);
    $this->assertSame((string)$value, (string)$ts);
  }
  
  public function testRaw() {
    $value = 200;
    $ts = new Timestamp($value);
    $this->assertSame($value, $ts->raw);
  }
  
  public function testToJson() {
    $value = 300;
    $ts = new Timestamp($value);
    $this->assertSame(json_encode($value), json_encode($ts));
  }
}
