<?php

use BapCat\Values\Ip;
use BapCat\Values\IpClass;
use PHPUnit\Framework\TestCase;

class IpTest extends TestCase {
  public function testEmpty(): void {
    $this->expectException(InvalidArgumentException::class);
    new Ip('');
  }

  public function testMalformed(): void {
    $this->expectException(InvalidArgumentException::class);
    new Ip('1.0.0');
  }

  public function testInvalid(): void {
    $this->expectException(InvalidArgumentException::class);
    new Ip('A');
  }

  public function testToString(): void {
    $value = '127.0.0.1';
    $ip = new Ip($value);
    $this->assertEquals($value, (string)$ip);
  }

  public function testRaw(): void {
    $value = '127.0.0.1';
    $ip = new Ip($value);
    $this->assertEquals($value, $ip->raw);
  }

  public function testToJson(): void {
    $value = '127.0.0.1';
    $ip = new Ip($value);
    $this->assertSame(json_encode($value), json_encode($ip));
  }

  public function testIPv4(): void {
    $raw = '127.0.0.1';
    $ip = new Ip($raw);
    $this->assertEquals($raw, $ip->asReadable());
    $this->assertEquals(inet_pton($raw), $ip->asBinary());
    $this->assertEquals($raw, (string)$ip);
  }

  public function testIPv6(): void {
    $raw = '1:2::3:4';
    $ip = new Ip($raw);
    $this->assertEquals($raw, $ip->asReadable());
    $this->assertEquals(inet_pton($raw), $ip->asBinary());
    $this->assertEquals($raw, (string)$ip);
  }

  public function testIPv4OnIPv6(): void {
    $raw = '::127.0.0.1';
    $ip = new Ip($raw);
    $this->assertEquals($raw, $ip->asReadable());
    $this->assertEquals(inet_pton($raw), $ip->asBinary());
    $this->assertEquals($raw, (string)$ip);
  }
}
