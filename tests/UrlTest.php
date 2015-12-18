<?php

use BapCat\Values\Url;

class AzorusRedirectUrlTest extends PHPUnit_Framework_TestCase {
  protected $url;
  
  protected function setUp() {
    $this->url = 'http://bapcat.com';
  }
  
  public function testMalformedUrl() {
    $this->setExpectedException(InvalidArgumentException::class);
    new Url('http://:80');
  }
  
  public function testNoScheme() {
    $this->setExpectedException(InvalidArgumentException::class);
    new Url('bapcat.com');
  }
  
  public function testNoHost() {
    $this->setExpectedException(InvalidArgumentException::class);
    new Url('http:');
  }
  
  public function testToString() {
    $url = new Url($this->url);
    $this->assertEquals($this->url, (string)$url);
  }
  
  public function testRaw() {
    $url = new Url($this->url);
    $this->assertEquals($this->url, $url->raw);
  }
  
  public function testToJson() {
    $url = new Url($this->url);
    $this->assertSame(json_encode($this->url), json_encode($url));
  }
}
