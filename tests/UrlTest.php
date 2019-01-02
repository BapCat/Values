<?php

use BapCat\Values\Url;
use PHPUnit\Framework\TestCase;

class UrlTest extends TestCase {
  protected $url;

  protected function setUp() {
    $this->url = 'http://bapcat.com';
  }

  public function testMalformedUrl(): void {
    $this->expectException(InvalidArgumentException::class);
    new Url('http://:80');
  }

  public function testNoScheme(): void {
    $this->expectException(InvalidArgumentException::class);
    new Url('bapcat.com');
  }

  public function testNoHost(): void {
    $this->expectException(InvalidArgumentException::class);
    new Url('http:');
  }

  public function testToString(): void {
    $url = new Url($this->url);
    $this->assertEquals($this->url, (string)$url);
  }

  public function testRaw(): void {
    $url = new Url($this->url);
    $this->assertEquals($this->url, $url->raw);
  }

  public function testToJson(): void {
    $url = new Url($this->url);
    $this->assertSame(json_encode($this->url), json_encode($url));
  }
}
