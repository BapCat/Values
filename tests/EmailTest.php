<?php

use BapCat\Values\Email;
use BapCat\Values\String;

class EmailTest extends PHPUnit_Framework_TestCase {
  public function testInvalid() {
    $this->setExpectedException('InvalidArgumentException');
    $email = new Email(new String('invalid'));
  }
  
  public function testEmpty() {
    $this->setExpectedException('InvalidArgumentException');
    $email = new Email(new String(''));
  }
  
  public function testValid() {
    $valid = 'corey@example.com';
    $email = new Email(new String($valid));
    $this->assertEquals($valid, $email->value());
    $this->assertEquals($valid, (string)$email);
  }
  
  public function testLocal() {
    $valid = 'corey@example.com';
    $email = new Email(new String($valid));
    $this->assertEquals('corey', $email->getLocal());
  }
  
  public function testDomain() {
    $valid = 'corey@example.com';
    $email = new Email(new String($valid));
    $this->assertEquals('example.com', $email->getDomain());
  }
}
