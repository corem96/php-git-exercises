<?php
namespace Bookstore\Models;

abstract class AbstractModel {
  private $db;

  public function __construct(PDO $db)
  {
    $this->db = $db;
  }
}

?>