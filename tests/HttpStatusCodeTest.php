<?php

use BapCat\Values\HttpStatusCode;

class HttpStatusCodeTest extends PHPUnit_Framework_TestCase {
  public function testAllMethodsExist() {
    $codes = [];
    
    foreach(HttpStatusCode::members() as $status) {
      $codes[] = $status->code;
    }
    
    $this->assertEmpty(array_diff([
      100, 101,
      200, 201, 202, 203, 204, 205, 206,
      300, 301, 302, 303, 304, 305, 307,
      400, 401, 402, 403, 404, 405, 406, 407, 408,
      409, 410, 411, 412, 413, 414, 415, 416, 417,
      500, 501, 502, 503, 504, 505
    ], $codes));
  }
  
  public function testAccessors() {
    $status = HttpStatusCode::NOT_FOUND();
    
    $this->assertSame(404, $status->code);
    $this->assertSame('Not Found', $status->text);
  }
}
