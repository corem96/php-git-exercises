<?php

namespace Bookstore\Exceptions;

use Exception;

class InvalidException extends Exception {
  public function __construct($message = null)
  {
    $message = $message ?: 'invalid id provided.';
    parent::__construct($message);
  }
}

?>