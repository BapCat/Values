<?php

use BapCat\Values\Boolean;

class BooleanTest extends PHPUnit_Framework_TestCase {
  public function testValidBoolean() {
    new Boolean(true);
    new Boolean(false);
  }
  
  public function testNotABoolean() {
    $this->setExpectedException('InvalidArgumentException');
    new Boolean('This is not a boolean');
  }
  
  public function testNull() {
    $this->setExpectedException('InvalidArgumentException');
    new Boolean(null);
  }
  
  public function testAccessors() {
    $bool = new Boolean(true);
    $this->assertTrue($bool->raw);
    $this->assertTrue($bool->true);
    $this->assertFalse($bool->false);
  }
}
