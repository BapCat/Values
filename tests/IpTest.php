<?php

use BapCat\Values\Ip;
use BapCat\Values\IpClass;

class IpTest extends PHPUnit_Framework_TestCase {
  public function testEmpty() {
    $this->setExpectedException(InvalidArgumentException::class);
    $ip = new Ip('');
  }
  
  public function testMalformed() {
    $this->setExpectedException(InvalidArgumentException::class);
    $ip = new Ip('1.0.0');
  }
  
  public function testInvalid() {
    $this->setExpectedException(InvalidArgumentException::class);
    $ip = new Ip('A');
  }
  
  public function testToString() {
    $value = '127.0.0.1';
    $ip = new Ip($value);
    $this->assertEquals($value, (string)$ip);
  }
  
  public function testRaw() {
    $value = '127.0.0.1';
    $ip = new Ip($value);
    $this->assertEquals($value, $ip->raw);
  }
  
  public function testToJson() {
    $value = '127.0.0.1';
    $ip = new Ip($value);
    $this->assertSame(json_encode($value), json_encode($ip));
  }
  
  public function testIPv4() {
    $raw = '127.0.0.1';
    $ip = new Ip($raw);
    $this->assertEquals($raw, $ip->asReadable());
    $this->assertEquals(inet_pton($raw), $ip->asBinary());
    $this->assertEquals($raw, (string)$ip);
  }
  
  public function testIPv6() {
    $raw = '1:2::3:4';
    $ip = new Ip($raw);
    $this->assertEquals($raw, $ip->asReadable());
    $this->assertEquals(inet_pton($raw), $ip->asBinary());
    $this->assertEquals($raw, (string)$ip);
  }
  
  public function testIPv4OnIPv6() {
    $raw = '::127.0.0.1';
    $ip = new Ip($raw);
    $this->assertEquals($raw, $ip->asReadable());
    $this->assertEquals(inet_pton($raw), $ip->asBinary());
    $this->assertEquals($raw, (string)$ip);
  }
}
