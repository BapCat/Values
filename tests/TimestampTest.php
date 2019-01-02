<?php

use BapCat\Values\Timestamp;
use PHPUnit\Framework\TestCase;

class TimestampTest extends TestCase {
  public function testValidTimestamps(): void {
    new Timestamp(PHP_INT_MAX);
    new Timestamp(0);
    new Timestamp(-PHP_INT_MAX);
    $this->assertTrue(true);
  }

  public function testNull(): void {
    $this->expectException(InvalidArgumentException::class);
    new Timestamp(null);
  }

  public function testFloat(): void {
    $this->assertSame(2.2, (new Timestamp(2.2))->raw);
  }

  public function testToString(): void {
    $value = 100;
    $ts = new Timestamp($value);
    $this->assertSame((string)$value, (string)$ts);
  }

  public function testRaw(): void {
    $value = 200;
    $ts = new Timestamp($value);
    $this->assertSame($value, $ts->raw);
  }

  public function testToJson(): void {
    $value = 300;
    $ts = new Timestamp($value);
    $this->assertSame(json_encode($value), json_encode($ts));
  }
}
