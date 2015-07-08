<?php

use BapCat\Values\Regex;
use BapCat\Values\String;

class RegexTest extends PHPUnit_Framework_TestCase {
  public function testValid() {
    $value = '/[a-z]/';
    $regex = new Regex($value);
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
  
  public function testCapture() {
    $pattern = '#@param[ \t]+?(\w+)[ \t]+?\$(\w+)[ \t]+(.+)#';
    $regex = new Regex($pattern);
    
    $string = new String(
      "@param String \$test This is a description\n" .
      "@param Uint   \$asdf Something different"
    );
    
    $capture = $regex->capture($string);
    
    $this->assertEquals([
      ['String', 'test', 'This is a description'],
      ['Uint',   'asdf', 'Something different']
    ], $capture);
  }
  
  public function testSplit() {
    $pattern = '#\s+#';
    $regex   = new Regex($pattern);
    $string  = new String('Split me       up');
    
    $parts = $regex->split($string);
    
    $this->assertEquals([
      new String('Split'), new String('me'), new String('up')
    ], $parts);
  }
  
  public function testSplitNoResults() {
    $pattern = '#\s+#';
    $regex   = new Regex($pattern);
    $string  = new String('Splitmeup');
    
    $parts = $regex->split($string);
    
    $this->assertEquals([$string], $parts);
  }
}
