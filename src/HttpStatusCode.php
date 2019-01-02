<?php declare(strict_types = 1); namespace BapCat\Values;

use BapCat\Propifier\PropifierTrait;

use Eloquent\Enumeration\AbstractMultiton;
use Eloquent\Enumeration\Exception\ExtendsConcreteException;

/**
 * Represents an HTTP status code
 *
 * @property-read  int     $code
 * @property-read  string  $text
 *
 * @method  static  HttpStatusCode  CONTINUE
 * @method  static  HttpStatusCode  SWITCHING_PROTOCOLS
 * @method  static  HttpStatusCode  OK
 * @method  static  HttpStatusCode  CREATED
 * @method  static  HttpStatusCode  ACCEPTED
 * @method  static  HttpStatusCode  NON_AUTHORITATIVE_INFORMATION
 * @method  static  HttpStatusCode  NO_CONTENT
 * @method  static  HttpStatusCode  RESET_CONTENT
 * @method  static  HttpStatusCode  PARTIAL_CONTENT
 * @method  static  HttpStatusCode  MULTIPLE_CHOICES
 * @method  static  HttpStatusCode  MOVED_PERMANENTLY
 * @method  static  HttpStatusCode  FOUND
 * @method  static  HttpStatusCode  SEE_OTHER
 * @method  static  HttpStatusCode  SET_MODIFIED
 * @method  static  HttpStatusCode  USE_PROXY
 * @method  static  HttpStatusCode  TEMPORARY_REDIRECT
 * @method  static  HttpStatusCode  BAD_REQUEST
 * @method  static  HttpStatusCode  UNAUTHORIZED
 * @method  static  HttpStatusCode  PAYMENT_REQUIRED
 * @method  static  HttpStatusCode  FORBIDDEN
 * @method  static  HttpStatusCode  NOT_FOUND
 * @method  static  HttpStatusCode  METHOD_NOT_ALLOWED
 * @method  static  HttpStatusCode  NOT_ACCEPTABLE
 * @method  static  HttpStatusCode  PROXY_AUTHENTICATION_REQUIRED
 * @method  static  HttpStatusCode  REQUEST_TIMEOUT
 * @method  static  HttpStatusCode  CONFLICT
 * @method  static  HttpStatusCode  GONE
 * @method  static  HttpStatusCode  LENGTH_REQUIRED
 * @method  static  HttpStatusCode  PRECONDITION_FAILED
 * @method  static  HttpStatusCode  REQUEST_ENTITY_TOO_LARGE
 * @method  static  HttpStatusCode  REQUEST_URI_TOO_LONG
 * @method  static  HttpStatusCode  UNSUPPORTED_MEDIA_TYPE
 * @method  static  HttpStatusCode  REQUESTED_RANGE_NOT_SATISFIABLE
 * @method  static  HttpStatusCode  EXPECTATION_FAILED
 * @method  static  HttpStatusCode  INTERNAL_SERVER_ERROR
 * @method  static  HttpStatusCode  BAD_GATEWAY
 * @method  static  HttpStatusCode  SERVICE_UNAVAILABLE
 * @method  static  HttpStatusCode  GATEWAY_TIMEOUT
 * @method  static  HttpStatusCode  HTTP_VERSION_NOT_SUPPORTED
 *
 * @author    Corey Frenette
 * @copyright Copyright (c) 2019, BapCat
 */
class HttpStatusCode extends AbstractMultiton {
  use PropifierTrait;

  /** @var  int  $code */
  private $code;

  /** @var  string  $text */
  private $text;

  protected function __construct(string $key, int $code, string $text) {
    parent::__construct($key);

    $this->code = $code;
    $this->text = $text;
  }

  /**
   * @throws  ExtendsConcreteException
   */
  protected static function initializeMembers(): void {
    new static('CONTINUE', 100, 'Continue');
    new static('SWITCHING_PROTOCOLS', 101, 'Switching Protocols');

    new static('OK', 200, 'OK');
    new static('CREATED', 201, 'Created');
    new static('ACCEPTED', 202, 'Accepted');
    new static('NON_AUTHORITATIVE_INFORMATION', 203, 'Non-Authoritative Information');
    new static('NO_CONTENT', 204, 'No Content');
    new static('RESET_CONTENT', 205, 'Reset Content');
    new static('PARTIAL_CONTENT', 206, 'Partial Content');

    new static('MULTIPLE_CHOICES', 300, 'Multiple Choices');
    new static('MOVED_PERMANENTLY', 301, 'Moved Permanently');
    new static('FOUND', 302, 'Found');
    new static('SEE_OTHER', 303, 'See Other');
    new static('NOT_MODIFIED', 304, 'Not Modified');
    new static('USE_PROXY', 305, 'Use Proxy');
    //new static('SWITCH_PROXY', 306, 'Switch Proxy');
    new static('TEMPORARY_REDIRECT', 307, 'Temporary Redirect');

    new static('BAD_REQUEST', 400, 'Bad Request');
    new static('UNAUTHORIZED', 401, 'Unauthorized');
    new static('PAYMENT_REQUIRED', 402, 'Payment Required');
    new static('FORBIDDEN', 403, 'Forbidden');
    new static('NOT_FOUND', 404, 'Not Found');
    new static('METHOD_NOT_ALLOWED', 405, 'Method Not Allowed');
    new static('NOT_ACCEPTABLE', 406, 'Not Acceptable');
    new static('PROXY_AUTHENTICATION_REQUIRED', 407, 'Proxy Authentication Required');
    new static('REQUEST_TIMEOUT', 408, 'Request Timeout');
    new static('CONFLICT', 409, 'Conflict');
    new static('GONE', 410, 'Gone');
    new static('LENGTH_REQUIRED', 411, 'Length Required');
    new static('PRECONDITION_FAILED', 412, 'Precondition Failed');
    new static('REQUEST_ENTITY_TOO_LARGE', 413, 'Request Entity Too Large');
    new static('REQUEST_URI_TOO_LONG', 414, 'Request URI Too Long');
    new static('UNSUPPORTED_MEDIA_TYPE', 415, 'Unsupported Media Type');
    new static('REQUESTED_RANGE_NOT_SATISFIABLE', 416, 'Requested Range Not Satisfiable');
    new static('EXPECTATION_FAILED', 417, 'Expectation Failed');

    new static('INTERNAL_SERVER_ERROR', 500, 'Internal Server Error');
    new static('NOT_IMPLEMENTED', 501, 'Not Implemented');
    new static('BAD_GATEWAY', 502, 'Bad Gateway');
    new static('SERVICE_UNAVAILABLE', 503, 'Service Unavailable');
    new static('GATEWAY_TIMEOUT', 504, 'Gateway Timeout');
    new static('HTTP_VERSION_NOT_SUPPORTED', 505, 'HTTP Version Not Supported');
  }

  protected function getCode(): int {
    return $this->code;
  }

  protected function getText(): string {
    return $this->text;
  }
}
