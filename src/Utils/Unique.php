<?php

namespace Bookstore\Utils;

trait Unique {
  protected $id;

  public function setId(int $id)
  {
    $this->id = $id;
  }

  public function getId()
  {
    return $this->id;
  }
}