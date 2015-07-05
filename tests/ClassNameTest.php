<?php

use BapCat\Values\ClassName;

class ClassNameTest extends PHPUnit_Framework_TestCase {
  public function testValidClass() {
    $class = new ClassName(ClassName::class);
  }
  
  public function testInvalidClass() {
    $this->setExpectedException('InvalidArgumentException');
    $class = new ClassName('This\Is\An\Invalid\Class');
  }
  
  public function testReflect() {
    $class = new ClassName(ClassName::class);
    $this->assertInstanceOf('ReflectionClass', $class->reflect());
  }
}
