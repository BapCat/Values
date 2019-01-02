<?php declare(strict_types = 1); namespace BapCat\Values;

use BapCat\Interfaces\Values\Value;

use InvalidArgumentException;

use function strlen;

/**
 * Represents a password
 *
 * @property-read  string  $raw
 *
 * @author    Corey Frenette
 * @copyright Copyright (c) 2019, BapCat
 */
class Password extends Value {
  /** @var  string  $raw  The raw password */
  private $raw;

  /**
   * @param  string  $password  The raw password to wrap
   */
  public function __construct($password) {
    $this->validate($password);

    $this->raw = $password;
  }

  /**
   * Ensures the password is valid
   *
   * @throws  InvalidArgumentException  If the password is not valid
   *
   * @param  string  $password  The password to validate
   *
   * @return  void
   */
  private function validate($password): void {
    if(strlen($password) < $this->validationMinLength()) {
      throw new InvalidArgumentException("The password must be at least {$this->validationMinLength()} characters long");
    }

    if(strlen($password) > $this->validationMaxLength()) {
      throw new InvalidArgumentException("The password must be no more than {$this->validationMaxLength()} characters long");
    }
  }

  /**
   * Used for validation, the minimum length a password can be
   *
   * @return  int  The minimum password length
   */
  protected function validationMinLength(): int {
    return 8;
  }

  /**
   * Used for validation, the maximum length a password can be
   *
   * @return  int  The maximum password length
   */
  protected function validationMaxLength(): int {
    return 56; // BCrypt limitation
  }

  /**
   * Converts this object to a string
   *
   * @return  string  A string representation of this object
   */
  public function __toString(): string {
    return $this->raw;
  }

  /**
   * Converts this object to a json encodable-form
   *
   * @return  string  A representation of this object suitable for encoding
   */
  public function jsonSerialize(): string {
    return $this->raw;
  }

  /**
   * Gets the raw value this object wraps
   *
   * @return  string  The raw value this object wraps
   */
  protected function getRaw(): string {
    return $this->raw;
  }
}
