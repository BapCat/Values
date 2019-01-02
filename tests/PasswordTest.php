<?php

use BapCat\Values\Password;
use PHPUnit\Framework\TestCase;

class PasswordTest extends TestCase {
  public function testConstructWithValidPassword(): void {
    new Password('This is a valid password');
    $this->assertTrue(true);
  }

  public function testConstructWithShortPassword(): void {
    $this->expectException(InvalidArgumentException::class);

    new Password('7 chars');
  }

  public function testConstructWithLongPassword(): void {
    $this->expectException(InvalidArgumentException::class);

    new Password(str_repeat('a', 57));
  }

  public function testGetRaw(): void {
    $raw = 'this is a test';
    $password = new Password($raw);

    $this->assertSame($raw, $password->raw);
  }

  public function testToString(): void {
    $raw = 'this is a test';
    $password = new Password($raw);

    $this->assertSame($raw, (string)$password);
  }

  public function testToJson(): void {
    $raw = 'this is a test';
    $password = new Password($raw);

    $this->assertSame(json_encode($raw), json_encode($password));
  }
}
