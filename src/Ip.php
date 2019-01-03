<?php declare(strict_types = 1); namespace BapCat\Values;

use InvalidArgumentException;

/**
 * Represents an IP address
 *
 * @property-read  string  $raw
 * @property-read  string  $binary
 * @property-read  string  $readable
 *
 * @author    Corey Frenette
 * @copyright Copyright (c) 2019, BapCat
 */
class Ip extends Value {
  /** @var  string  $raw  The raw IP address */
  private $raw;

  /** @var  string  $bin  The binary IP address */
  private $bin;

  /**
   * @param  string  $ip  The raw IP to wrap
   */
  public function __construct($ip) {
    $bin = @inet_pton($ip);

    if($bin === false) {
      throw new InvalidArgumentException('Expected IP, but got [' . var_export($ip, true) . '] instead');
    }

    $this->raw = $ip;
    $this->bin = $bin;
  }

  /**
   * Converts this object to a string
   *
   * @return  string  A string representation of this object
   */
  public function __toString(): string {
    return $this->asReadable();
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
   * Gets the binary representation of this IP
   *
   * @return  string  The binary representation of this object
   */
  public function asBinary(): string {
    return $this->bin;
  }

  /**
   * Gets the human-readable dotted decimal representation of this IP
   *
   * @return  string  The human-readable representation of this object
   */
  public function asReadable(): string {
    return $this->raw;
  }
}
