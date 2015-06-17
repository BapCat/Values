<?php

use BapCat\Values\Email;

class EmailTest extends PHPUnit_Framework_TestCase {
  public function testInvalid() {
    $this->setExpectedException('InvalidArgumentException');
    $email = new Email('invalid');
  }
  
  public function testEmpty() {
    $this->setExpectedException('InvalidArgumentException');
    $email = new Email('');
  }
  
  public function testValid() {
    $valid = 'corey@example.com';
    $email = new Email($valid);
    $this->assertEquals($valid, $email->value());
    $this->assertEquals($valid, (string)$email);
  }
  
  public function testLocal() {
    $valid = 'corey@example.com';
    $email = new Email($valid);
    $this->assertEquals('corey', $email->getLocal());
  }
  
  public function testDomain() {
    $valid = 'corey@example.com';
    $email = new Email($valid);
    $this->assertEquals('example.com', $email->getDomain());
  }
}
