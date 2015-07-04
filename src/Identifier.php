<?php namespace BapCat\Values;

use BapCat\Interfaces\Values\Value;

abstract class Identifier extends Value {
  private $id = null;
  
  protected function __construct($id) {
    $this->id = $id;
  }
  
  public function id() {
    return $this->id;
  }
}
