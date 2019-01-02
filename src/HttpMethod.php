<?php declare(strict_types = 1); namespace BapCat\Values;

use Eloquent\Enumeration\AbstractEnumeration;

/**
 * Represents an HTTP request method
 *
 * @author    Corey Frenette
 * @copyright Copyright (c) 2019, BapCat
 */
class HttpMethod extends AbstractEnumeration {
  public const OPTIONS = 'OPTIONS';
  public const GET     = 'GET';
  public const HEAD    = 'HEAD';
  public const POST    = 'POST';
  public const PUT     = 'PUT';
  public const DELETE  = 'DELETE';
  public const TRACE   = 'TRACE';
  public const CONNECT = 'CONNECT';
}
