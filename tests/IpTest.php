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
  
  public function testInvalid() {
    $this->setExpectedException('InvalidArgumentException');
    $ip = new Ip('A');
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
