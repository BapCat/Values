<?php

use BapCat\Values\Regex;
use BapCat\Values\Text;

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
    $this->assertTrue($regex->check(new Text('asdf')));
    $this->assertTrue($regex->check(new Text('as1df')));
  }
  
  public function testCapture() {
    $pattern = '#@param[ \t]+?(\w+)[ \t]+?\$(\w+)[ \t]+(.+)#';
    $regex = new Regex($pattern);
    
    $text = new Text(
      "@param Text \$test This is a description\n" .
      "@param Uint \$asdf Something different"
    );
    
    $capture = $regex->capture($text);
    
    $this->assertEquals([
      ['Text', 'test', 'This is a description'],
      ['Uint', 'asdf', 'Something different']
    ], $capture);
  }
  
  public function testSplit() {
    $pattern = '#\s+#';
    $regex   = new Regex($pattern);
    $text  = new Text('Split me       up');
    
    $parts = $regex->split($text);
    
    $this->assertEquals([
      new Text('Split'), new Text('me'), new Text('up')
    ], $parts);
  }
  
  public function testSplitNoResults() {
    $pattern = '#\s+#';
    $regex   = new Regex($pattern);
    $text  = new Text('Splitmeup');
    
    $parts = $regex->split($text);
    
    $this->assertEquals([$text], $parts);
  }
}
