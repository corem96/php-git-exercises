<?php

namespace Bookstore\Core;

/**
 * A concrete class that manage all requests submited
 */
class Request {
  const GET = 'GET';
  const POST = 'POST';
  
  private $domain;
  private $path;
  private $method;
  private $params;
  private $cookies;

  public function __construct()
  {
    $this->domain = $_SERVER['HTTP_HOST'];
    $this->path = $_SERVER['REQUEST_URI'];
    $this->method = $_SERVER['REQUEST_METHOD'];
    $this->params = new FilteredMap(
      array_merge($_POST, $_GET)
    );
    $this->cookies = new FilteredMap($_COOKIE);
  }

  public function getUrl() : string
  {
    return $this->domain . $this->path;
  }

  public function getDomain() : string
  {
    return $this->domain;
  }

  public function getPath() : string
  {
    return $this->path;
  }

  public function getMethod() : string
  {
    return $this->method;
  }

  /**
   * Return true if the verb of THE request is POST
   *
   * @return boolean
   */
  public function isPost() : bool
  {
    return $this->method === self::POST;
  }

  public function isGet() : bool
  {
    return $this->method === self::GET;
  }

  /**
   * Returns a filtered map of params included in the current request
   *
   * @return FilteredMap
   */
  public function getParams() : FilteredMap
  {
    return $this->params;
  }

  public function getCookies() : FilteredMap
  {
    return $this->cookies;
  }
}