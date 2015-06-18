<?php

use BapCat\Values\Regex;
use BapCat\Values\String;

class RegexTest extends PHPUnit_Framework_TestCase {
  public function testValid() {
    $value = '/[a-z]/';
    $regex = new Regex($value);
    $this->assertEquals($value, $regex->value());
    $this->assertEquals($value, (string)$regex);
  }
  
  public function testInvalid() {
    $this->setExpectedException('InvalidArgumentException');
    
    $value = '/a-z)/';
    $regex = new Regex($value);
  }
  
  public function testCheck() {
    $value = '/[a-z]/';
    $regex = new Regex($value);
    $this->assertTrue($regex->check(new String('asdf')));
    $this->assertTrue($regex->check(new String('as1df')));
  }
}
