<?php

use BapCat\Values\Regex;
use BapCat\Values\Text;
use PHPUnit\Framework\TestCase;

class RegexTest extends TestCase {
  public function testValid(): void {
    $value = '/[a-z]/';
    $regex = new Regex($value);
    $this->assertEquals($value, (string)$regex);
  }

  public function testInvalid(): void {
    $this->expectException(InvalidArgumentException::class);

    $value = '/a-z)/';
    new Regex($value);
  }

  public function testToString(): void {
    $value = '/[a-z]/';
    $regex = new Regex($value);
    $this->assertEquals($value, (string)$regex);
  }

  public function testRaw(): void {
    $value = '/[a-z]/';
    $regex = new Regex($value);
    $this->assertEquals($value, $regex->raw);
  }

  public function testToJson(): void {
    $value = '/[a-z]/';
    $regex = new Regex($value);
    $this->assertSame(json_encode($value), json_encode($regex));
  }

  public function testCheck(): void {
    $value = '/[a-z]/';
    $regex = new Regex($value);
    $this->assertTrue($regex->check(new Text('asdf')));
    $this->assertTrue($regex->check(new Text('as1df')));
  }

  public function testCapture(): void {
    $pattern = '#@param[ \t]+?(\w+)[ \t]+?\$(\w+)[ \t]+(.+)#';
    $regex = new Regex($pattern);

    $text = new Text(
      "@param Text \$test This is a description\n" .
      '@param Uint $asdf Something different'
    );

    $capture = $regex->capture($text);

    $this->assertEquals([
      ['Text', 'test', 'This is a description'],
      ['Uint', 'asdf', 'Something different']
    ], $capture);
  }

  public function testSplit(): void {
    $pattern = '#\s+#';
    $regex   = new Regex($pattern);
    $text    = new Text('Split me       up');

    $parts = $regex->split($text);

    $this->assertEquals([
      new Text('Split'), new Text('me'), new Text('up')
    ], $parts);
  }

  public function testSplitNoResults(): void {
    $pattern = '#\s+#';
    $regex   = new Regex($pattern);
    $text    = new Text('Splitmeup');

    $parts = $regex->split($text);

    $this->assertEquals([$text], $parts);
  }

  public function testReplace(): void {
    $pattern  = '#replace this#';
    $regex    = new Regex($pattern);
    $text     = new Text('This is replace this test');
    $replaced = $regex->replace($text, new Text('a'));

    $this->assertSame('This is a test', $replaced->raw);
  }
}
