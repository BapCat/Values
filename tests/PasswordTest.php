<?php

use BapCat\Values\Password;

class PasswordTest extends PHPUnit_Framework_TestCase {
  public function testConstructWithValidPassword() {
    new Password('This is a valid password');
  }
  
  public function testConstructWithShortPassword() {
    $this->setExpectedException(InvalidArgumentException::class);
    
    new Password('7 chars');
  }
  
  public function testConstructWithLongPassword() {
    $this->setExpectedException(InvalidArgumentException::class);
    
    new Password(str_repeat('a', 57));
  }
  
  public function testGetRaw() {
    $raw = 'this is a test';
    $password = new Password($raw);
    
    $this->assertSame($raw, $password->raw);
  }
  
  public function testToString() {
    $raw = 'this is a test';
    $password = new Password($raw);
    
    $this->assertSame($raw, (string)$password);
  }
  
  public function testToJson() {
    $raw = 'this is a test';
    $password = new Password($raw);
    
    $this->assertSame(json_encode($raw), json_encode($password));
  }
}
