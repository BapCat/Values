<?php namespace BapCat\Values;

use Eloquent\Enumeration\AbstractEnumeration;

/**
 * Represents an HTTP request method
 * 
 * @author    Corey Frenette
 * @copyright Copyright (c) 2015, BapCat
 */
class HttpRequestMethod extends AbstractEnumeration {
  const OPTIONS = 'OPTIONS';
  const GET     = 'GET';
  const HEAD    = 'HEAD';
  const POST    = 'POST';
  const PUT     = 'PUT';
  const DELETE  = 'DELETE';
  const TRACE   = 'TRACE';
  const CONNECT = 'CONNECT';
}
