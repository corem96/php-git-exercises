<?php

namespace Bookstore\Domain;

class Book{
  private $id;
  private $isbn;
  private $title;
  private $author;
  private $stock;
  private $price;

  

  /**
   * Returns value of ID
   *
   * @return integer
   */
  public function getId() : int
  {
    return $this->id;
  }

  /**
   * Returns value of ISBN
   *
   * @return string
   */ 
  public function getIsbn() : string
  {
    return $this->isbn;
  }

  /**
   * Returns value of Title
   *
   * @return string
   */
  public function getTitle() : string
  {
    return $this->title;
  }

  /**
   * Returns value of Author
   *
   * @return string
   */
  public function getAuthor() : string
  {
    return $this->author;
  }

  /**
   * Returns value of Stock
   *
   * @return integer
   */
  public function getStock() : int
  {
    return $this->stock;
  }

  /**
   * Returns value of Price
   *
   * @return float
   */ 
  public function getPrice() : float
  {
    return $this->price;
  }

  /**
   * Returns true when stock value is avobe 0 and reduces stock by one.
   * Returns false when stock is equal or less than 0
   *
   * @return boolean
   */
  public function getCopy() : bool
  {
    if($this->stock < 1){
      return false;
    } else {
      $this->stock--; 
      return true;
    }
  }

  /**
   * Increases stock by one
   *
   * @return void
   */
  public function addCopy()
  {
    $this->stock++;
  }
}