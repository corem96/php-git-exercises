<?php

namespace Bookstore\Utils;

use Bookstore\Exceptions\InvalidException;

trait Unique {
  private static $lastId = 0;
  protected $id;

  public function setId(int $id = null)
  {
    if (empty($id)) {
      // throw new InvalidException('Id cannot be negative nor null');
      
      $this->id = ++self::$lastId;
    } else {
      $this->id = $id;
      if($id > self::$lastId) {
        self::$lastId = $id;
      }
    }
  }

  public static function getLastId() : int
  {
    return self::$lastId;
  }

  public function getId() : int
  {
    return $this->id;
  }
}

?>