<?php namespace BapCat\Values;

use BapCat\Propifier\PropifierTrait;

use Eloquent\Enumeration\AbstractMultiton;

/**
 * Represents an HTTP status code
 * 
 * @author    Corey Frenette
 * @copyright Copyright (c) 2015, BapCat
 */
class HttpStatusCode extends AbstractMultiton {
  use PropifierTrait;
  
  private $code;
  private $text;
  
  protected function __construct($key, $code, $text) {
    parent::__construct($key);
    
    $this->code = $code;
    $this->text = $text;
  }
  
  protected static function initializeMembers() {
    new static('CONTINUE', 100, 'Continue');
    new static('SWITCHING PROTOCOLS', 101, 'Switching Protocols');
    
    new static('OK', 200, 'OK');
    new static('CREATED', 201, 'Created');
    new static('ACCEPTED', 202, 'Accepted');
    new static('NON_AUTORATIVE_INFORMATION', 203, 'Non-Authoritative Information');
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
    new static('SERVICE UNAVAILABLE', 503, 'Serivce Unavailable');
    new static('GATEWAY TIMEOUT', 504, 'Gateway Timeout');
    new static('HTTP_VERSION_NOT_SUPPORTED', 505, 'HTTP Version Not Supported');
  }
  
  protected function getCode() {
    return $this->code;
  }
  
  protected function getText() {
    return $this->text;
  }
}
