<?php

use BapCat\Values\HttpMethod;

class HttpMethodTest extends PHPUnit_Framework_TestCase {
  public function testAllMethodsExist() {
    $this->assertEmpty(array_diff([
      'OPTIONS', 'GET', 'HEAD', 'POST', 'PUT', 'DELETE', 'TRACE', 'CONNECT'
    ], array_keys(HttpMethod::members())));
  }
}
