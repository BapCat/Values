<?php declare(strict_types = 1); namespace BapCat\Values;

use BapCat\Propifier\PropifierTrait;

use JsonSerializable;

/**
 * Defines a class that represents a complex type
 *
 * @author    Corey Frenette
 * @copyright Copyright (c) 2019, BapCat
 */
abstract class Value implements JsonSerializable {
  use PropifierTrait;

  /**
   * Gets the raw data from a value object
   *
   * @return  mixed
   */
  protected abstract function getRaw();
}
