<?php declare(strict_types = 1);

use BapCat\Values\ClassName;
use PHPUnit\Framework\TestCase;

class ClassNameTest extends TestCase {
  public function testValidClass(): void {
    new ClassName(ClassName::class);
    $this->assertTrue(true);
  }

  public function testInvalidClass(): void {
    $this->expectException(InvalidArgumentException::class);
    new ClassName('This\Is\An\Invalid\Class');
  }

  public function testToString(): void {
    $value = ClassName::class;
    $class = new ClassName($value);
    $this->assertEquals($value, (string)$class);
  }

  public function testRaw(): void {
    $value = ClassName::class;
    $class = new ClassName($value);
    $this->assertEquals($value, $class->raw);
  }

  public function testToJson(): void {
    $value = ClassName::class;
    $class = new ClassName($value);
    $this->assertSame(json_encode($value), json_encode($class));
  }

  public function testReflect(): void {
    $class = new ClassName(ClassName::class);
    $this->assertInstanceOf('ReflectionClass', $class->reflect());
  }
}
