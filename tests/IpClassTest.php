<?php

use BapCat\Values\IpClass;

class IpClassTest extends PHPUnit_Framework_TestCase {
  public function testIpClasses() {
    $this->assertEquals(   8, IpClass::A()->cidr());
    $this->assertEquals(  16, IpClass::B()->cidr());
    $this->assertEquals(  24, IpClass::C()->cidr());
    $this->assertEquals(null, IpClass::D()->cidr());
    $this->assertEquals(null, IpClass::E()->cidr());
  }
}
