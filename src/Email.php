<?php declare(strict_types = 1); namespace BapCat\Values;

use InvalidArgumentException;

/**
 * Represents a class
 *
 * @property-read  string  $raw
 * @property-read  Text    $local_part
 * @property-read  Text    $domain_part
 *
 * @author    Corey Frenette
 * @copyright Copyright (c) 2019, BapCat
 */
class Email extends Value {
  /** @var  Text  $local  The local (pre-@) part of the email */
  private $local;

  /** @var  Text  $domain  The domain (post-@) part of the email*/
  private $domain;

  /** @var  string  $raw  The raw email */
  private $raw;

  /**
   * @param  string  $email  The raw class name to wrap
   */
  public function __construct($email) {
    $this->validate($email);
    $this->raw = $email;
    $parts = explode('@', $email);

    //TODO: This probably shouldn't be text
    $this->domain = new Text(array_pop($parts));
    $this->local  = new Text(implode('@', $parts));
  }

  /**
   * Ensures the valid passed in is a valid email
   *
   * @throws  InvalidArgumentException  If the value is not a valid email
   *
   * @param  string  $email  The value to validate
   *
   * @return  void
   */
  private function validate($email): void {
    if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
      throw new InvalidArgumentException('Expected email address, but got [' . var_export($email, true) . '] instead');
    }
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

  /**
   * Gets the local part of this email
   *
   * @return  Text  The local part of this email
   */
  protected function getLocalPart(): Text {
    return $this->local;
  }

  /**
   * Gets the domain part of this email
   *
   * @return  Text  The domain part of this email
   */
  protected function getDomainPart(): Text {
    return $this->domain;
  }
}
