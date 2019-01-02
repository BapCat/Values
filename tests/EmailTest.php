<?php declare(strict_types = 1);

use BapCat\Values\Email;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase {
  public function testInvalid(): void {
    $this->expectException(InvalidArgumentException::class);
    new Email('invalid');
  }

  public function testEmpty(): void {
    $this->expectException(InvalidArgumentException::class);
    new Email('');
  }

  public function testValid(): void {
    $valid = 'corey@example.com';
    $email = new Email($valid);
    $this->assertEquals($valid, (string)$email);
  }

  public function testToString(): void {
    $valid = 'corey@example.com';
    $email = new Email($valid);
    $this->assertEquals($valid, (string)$email);
  }

  public function testRaw(): void {
    $valid = 'corey@example.com';
    $email = new Email($valid);
    $this->assertEquals($valid, $email->raw);
  }

  public function testToJson(): void {
    $value = 'corey@example.com';
    $email = new Email($value);
    $this->assertSame(json_encode($value), json_encode($email));
  }

  public function testLocal(): void {
    $valid = 'corey@example.com';
    $email = new Email($valid);
    $this->assertEquals('corey', $email->local_part);
  }

  public function testDomain(): void {
    $valid = 'corey@example.com';
    $email = new Email($valid);
    $this->assertEquals('example.com', $email->domain_part);
  }
}
