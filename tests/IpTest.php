<?php

use BapCat\Values\Ip;
use BapCat\Values\IpClass;

class IpTest extends PHPUnit_Framework_TestCase {
  public function testEmpty() {
    $this->setExpectedException('InvalidArgumentException');
    $ip = new Ip('');
  }
  
  public function testMalformed() {
    $this->setExpectedException('InvalidArgumentException');
    $ip = new Ip('1.0.0');
  }
  
  public function testText() {
    $this->setExpectedException('InvalidArgumentException');
    $ip = new Ip('A');
  }
  
  public function testAccessors() {
    $raw = '1.2.3.4';
    $ip = new Ip($raw);
    
    $this->assertEquals(1, $ip->getOctet(0));
    $this->assertEquals(2, $ip->getOctet(1));
    $this->assertEquals(3, $ip->getOctet(2));
    $this->assertEquals(4, $ip->getOctet(3));
    $this->assertEquals($raw, $ip->asDottedDecimal());
    $this->assertEquals($raw, $ip->value());
    $this->assertEquals($raw, (string)$ip);
    $this->assertEquals(ip2long($raw), $ip->asInteger());
  }
  
  public function testInvalidOctet() {
    $this->setExpectedException('InvalidArgumentException');
    
    $raw = '1.2.3.4';
    $ip = new Ip($raw);
    
    $ip->getOctet(4);
  }
  
  public function testClassAPublic() {
    $raw = '1.0.0.0';
    $ip = new Ip($raw);
    
    $this->assertEquals(IpClass::A(), $ip->getClass());
    $this->assertFalse($ip->isLocal());
    $this->assertFalse($ip->isPrivate());
  }
  
  public function testClassAPrivate() {
    $raw = '10.0.0.0';
    $ip = new Ip($raw);
    
    $this->assertEquals(IpClass::A(), $ip->getClass());
    $this->assertFalse($ip->isLocal());
    $this->assertTrue($ip->isPrivate());
  }
  
  public function testLocalhost() {
    $raw = '127.0.0.1';
    $ip = new Ip($raw);
    
    $this->assertEquals(IpClass::A(), $ip->getClass());
    $this->assertTrue($ip->isLocal());
    $this->assertTrue($ip->isPrivate());
  }
  
  public function testClassBPublic() {
    $raw = '128.0.0.1';
    $ip = new Ip($raw);
    
    $this->assertEquals(IpClass::B(), $ip->getClass());
    $this->assertFalse($ip->isLocal());
    $this->assertFalse($ip->isPrivate());
  }
  
  public function testClassBPrivate() {
    $raw = '172.16.0.1';
    $ip = new Ip($raw);
    
    $this->assertEquals(IpClass::B(), $ip->getClass());
    $this->assertFalse($ip->isLocal());
    $this->assertTrue($ip->isPrivate());
  }
  
  public function testClassCPublic() {
    $raw = '193.0.0.0';
    $ip = new Ip($raw);
    
    $this->assertEquals(IpClass::C(), $ip->getClass());
    $this->assertFalse($ip->isLocal());
    $this->assertFalse($ip->isPrivate());
  }
  
  public function testClassCPrivate() {
    $raw = '192.168.1.1';
    $ip = new Ip($raw);
    
    $this->assertEquals(IpClass::C(), $ip->getClass());
    $this->assertFalse($ip->isLocal());
    $this->assertTrue($ip->isPrivate());
  }
  
  public function testClassD() {
    $raw = '224.0.0.0';
    $ip = new Ip($raw);
    
    $this->assertEquals(IpClass::D(), $ip->getClass());
    $this->assertFalse($ip->isLocal());
    $this->assertFalse($ip->isPrivate());
  }
  
  public function testClassE() {
    $raw = '240.0.0.0';
    $ip = new Ip($raw);
    
    $this->assertEquals(IpClass::E(), $ip->getClass());
    $this->assertFalse($ip->isLocal());
    $this->assertFalse($ip->isPrivate());
  }
}
