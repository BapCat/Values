<?php declare(strict_types = 1);

use BapCat\Values\HttpMethod;
use PHPUnit\Framework\TestCase;

class HttpMethodTest extends TestCase {
  public function testAllMethodsExist(): void {
    $this->assertEmpty(array_diff([
      'OPTIONS', 'GET', 'HEAD', 'POST', 'PUT', 'DELETE', 'TRACE', 'CONNECT'
    ], array_keys(HttpMethod::members())));
  }
}
