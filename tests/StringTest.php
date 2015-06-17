<?php

use BapCat\Values\String;

class StringTest extends PHPUnit_Framework_TestCase {
  public function testString() {
    $value = 'test';
    $string = new String($value);
    $this->assertEquals($value, $string->value());
    $this->assertEquals($value, (string)$string);
  }
  
  public function testInvalid() {
    $this->setExpectedException('InvalidArgumentException');
    
    $value = true;
    $string = new String($value);
  }
  
  public function testEquals() {
    $value = 'test';
    
    $s1 = new String($value);
    $s2 = new String($value);
    
    $this->assertTrue($s1->equals($s2));
  }
  
  public function testLength() {
    $string = new String('test');
    $this->assertEquals(4, $string->length());
  }
  
  public function testIsEmpty() {
    $string = new String('test');
    $empty  = new String('');
    
    $this->assertFalse($string->isEmpty());
    $this->assertTrue($empty->isEmpty());
  }
  
  public function testStartsWith() {
    $string = new String('This is a test');
    $thisIs = new String('This is');
    $isA    = new String('is a');
    
    $this->assertTrue($string->startsWith($thisIs));
    $this->assertFalse($string->startsWith($isA));
  }
  
  public function testEndsWith() {
    $string = new String('This is a test');
    $aTest  = new String('a test');
    $isA    = new String('is a');
    
    $this->assertTrue($string->endsWith($aTest));
    $this->assertFalse($string->endsWith($isA));
  }
  
  public function testContains() {
    $string = new String('This is a test');
    $isA    = new String('is a');
    
    $this->assertTrue($string->contains($isA));
    $this->assertFalse($isA->contains($string));
  }
  
  public function testSubstring() {
    $string = new String('This is a test');
    
    $this->assertEquals('test', $string->substring(10)->value());
    $this->assertEquals('This is', $string->substring(0, 7)->value());
  }
  
  public function testTrim() {
    $string = new String('  test    ');
    
    $this->assertEquals('test', $string->trim()->value());
  }
  
  public function testPad() {
    $string = new String('test');
    
    $this->assertEquals('test  ', $string->pad(6)->value());
  }
  
  public function testToUpperCase() {
    $string = new String('tEsT');
    
    $this->assertEquals('TEST', $string->toUpperCase()->value());
  }
  
  public function testToLowerCase() {
    $string = new String('tEsT');
    
    $this->assertEquals('test', $string->toLowerCase()->value());
  }
}
