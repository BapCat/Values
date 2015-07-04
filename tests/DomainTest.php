<?php

use BapCat\Values\Domain;

class DomainTest extends PHPUnit_Framework_TestCase {
  public function testValid() {
    $value = 'hostname';
    $domain = new Domain($value);
    $this->assertEquals($value, (string)$domain);
  }
  
  public function testInvalid() {
    //@TODO
  }
  
  public function testNested() {
    $tld = new Domain('com');
    $bap = new Domain('bapcat', $tld);
    $this->assertEquals('bapcat.com', (string)$bap);
  }
}
