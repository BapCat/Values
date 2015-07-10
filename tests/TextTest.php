<?php

use BapCat\Values\Regex;
use BapCat\Values\Text;

class TextTest extends PHPUnit_Framework_TestCase {
  public function testString() {
    $value = 'test';
    $text = new Text($value);
    $this->assertEquals($value, (string)$text);
  }
  
  public function testInvalid() {
    $this->setExpectedException('InvalidArgumentException');
    
    $value = true;
    new Text($value);
  }
  
  public function testEquals() {
    $value = 'test';
    
    $t1 = new Text($value);
    $t2 = new Text($value);
    
    $this->assertTrue($t1->equals($t2));
  }
  
  public function testLength() {
    $text = new Text('test');
    $this->assertEquals(4, $text->length());
  }
  
  public function testIsEmpty() {
    $text  = new Text('test');
    $empty = new Text('');
    
    $this->assertFalse($text->isEmpty());
    $this->assertTrue($empty->isEmpty());
  }
  
  public function testStartsWith() {
    $text   = new Text('This is a test');
    $thisIs = new Text('This is');
    $isA    = new Text('is a');
    
    $this->assertTrue($text->startsWith($thisIs));
    $this->assertFalse($text->startsWith($isA));
  }
  
  public function testEndsWith() {
    $text  = new Text('This is a test');
    $aTest = new Text('a test');
    $isA   = new Text('is a');
    
    $this->assertTrue($text->endsWith($aTest));
    $this->assertFalse($text->endsWith($isA));
  }
  
  public function testContains() {
    $text = new Text('This is a test');
    $isA  = new Text('is a');
    
    $this->assertTrue($text->contains($isA));
    $this->assertFalse($isA->contains($text));
  }
  
  public function testMatches() {
    $regex = $this->getMockBuilder('BapCat\Values\Regex')
      ->disableOriginalConstructor()
      ->getMock();
    
    $regex->method('check')
      ->willReturn(true);
    
    $text = new Text('This is a test');
    $this->assertTrue($text->matches($regex));
  }
  
  public function testSubstring() {
    $text = new Text('This is a test');
    
    $this->assertEquals('test', (string)$text->substring(10));
    $this->assertEquals('This is', (string)$text->substring(0, 7));
  }
  
  public function testConcat() {
    $s1 = new Text('a ');
    $s2 = new Text('test');
    
    (string)$this->assertEquals('a test', $s1->concat($s2));
  }
  
  public function testTrim() {
    $text = new Text('  test    ');
    
    $this->assertEquals('test', (string)$text->trim());
  }
  
  public function testPad() {
    $text = new Text('test');
    
    $this->assertEquals('test  ', (string)$text->pad(6));
  }
  
  public function testToUpperCase() {
    $text = new Text('tEsT');
    
    $this->assertEquals('TEST', (string)$text->toUpperCase());
  }
  
  public function testToLowerCase() {
    $text = new Text('tEsT');
    
    $this->assertEquals('test', (string)$text->toLowerCase());
  }
  
  public function testReplace() {
    $text    = new Text('Replace me');
    $search  = new Text('me');
    $replace = new Text('yourself');
    
    $this->assertEquals('Replace yourself', $text->replace($search, $replace));
  }
  
  public function testSplitByString() {
    $text  = new Text('Split me up');
    $delim = new Text(' ');
    $parts = $text->split($delim);
    
    $this->assertEquals([
      new Text('Split'), new Text('me'), new Text('up')
    ], $parts);
  }
}
