<?php

use BapCat\Values\Regex;
use BapCat\Values\Text;
use PHPUnit\Framework\TestCase;

class TextTest extends TestCase {
  public function testString(): void {
    $value = 'test';
    $text = new Text($value);
    $this->assertEquals($value, (string)$text);
  }

  public function testInvalid(): void {
    $this->expectException(InvalidArgumentException::class);

    $value = true;
    new Text($value);
  }

  public function testToString(): void {
    $value = 'test';
    $text = new Text($value);
    $this->assertEquals($value, (string)$text);
  }

  public function testRaw(): void {
    $value = 'test';
    $text = new Text($value);
    $this->assertEquals($value, $text->raw);
  }

  public function testToJson(): void {
    $value = 'test';
    $text = new Text($value);
    $this->assertSame(json_encode($value), json_encode($text));
  }

  public function testEquals(): void {
    $value = 'test';

    $t1 = new Text($value);
    $t2 = new Text($value);

    $this->assertTrue($t1->equals($t2));
    $this->assertFalse($t1->equals(null));
  }

  public function testLength(): void {
    $text = new Text('test');
    $this->assertEquals(4, $text->length);
  }

  public function testIsEmpty(): void {
    $text  = new Text('test');
    $empty = new Text('');

    $this->assertFalse($text->is_empty);
    $this->assertTrue($empty->is_empty);
  }

  public function testStartsWith(): void {
    $text   = new Text('This is a test');
    $thisIs = new Text('This is');
    $isA    = new Text('is a');

    $this->assertTrue($text->startsWith($thisIs));
    $this->assertFalse($text->startsWith($isA));
  }

  public function testEndsWith(): void {
    $text  = new Text('This is a test');
    $aTest = new Text('a test');
    $isA   = new Text('is a');

    $this->assertTrue($text->endsWith($aTest));
    $this->assertFalse($text->endsWith($isA));
  }

  public function testContains(): void {
    $text = new Text('This is a test');
    $isA  = new Text('is a');

    $this->assertTrue($text->contains($isA));
    $this->assertFalse($isA->contains($text));
  }

  public function testMatches(): void {
    $regex = $this->getMockBuilder(Regex::class)
      ->disableOriginalConstructor()
      ->getMock();

    $regex->method('check')
      ->willReturn(true);

    $text = new Text('This is a test');
    $this->assertTrue($text->matches($regex));
  }

  public function testSubstring(): void {
    $text = new Text('This is a test');

    $this->assertEquals('test', (string)$text->substring(10));
    $this->assertEquals('This is', (string)$text->substring(0, 7));
  }

  public function testConcat(): void {
    $s1 = new Text('a ');
    $s2 = new Text('test');

    $this->assertEquals('a test', $s1->concat($s2));
  }

  public function testTrim(): void {
    $text = new Text('  test    ');

    $this->assertEquals('test', (string)$text->trim());
  }

  public function testPad(): void {
    $text = new Text('test');

    $this->assertEquals('test  ', (string)$text->pad(6));
  }

  public function testToUpperCase(): void {
    $text = new Text('tEsT');

    $this->assertEquals('TEST', (string)$text->toUpperCase());
  }

  public function testToLowerCase(): void {
    $text = new Text('tEsT');

    $this->assertEquals('test', (string)$text->toLowerCase());
  }

  public function testReplace(): void {
    $text    = new Text('Replace me');
    $search  = new Text('me');
    $replace = new Text('yourself');

    $this->assertEquals('Replace yourself', $text->replace($search, $replace));
  }

  public function testReplaceByRegex(): void {
    $text    = new Text('Replace me');
    $search  = new Regex('#me#');
    $replace = new Text('yourself');

    $this->assertEquals('Replace yourself', $text->replaceByRegex($search, $replace));
  }

  public function testSplitByString(): void {
    $text  = new Text('Split me up');
    $delim = new Text(' ');
    $parts = $text->split($delim);

    $this->assertEquals([
      new Text('Split'), new Text('me'), new Text('up')
    ], $parts);
  }
}
