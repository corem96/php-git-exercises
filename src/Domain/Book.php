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
   * Get the value of id
   */ 
  public function getId() : int
  {
    return $this->id;
  }

  /**
   * Get the value of isbn
   */ 
  public function getIsbn() : string
  {
    return $this->isbn;
  }

  /**
   * Get the value of title
   */ 
  public function getTitle() : string
  {
    return $this->title;
  }

  /**
   * Get the value of author
   */ 
  public function getAuthor() : string
  {
    return $this->author;
  }

  /**
   * Get the value of stock
   */ 
  public function getStock() : int
  {
    return $this->stock;
  }

  /**
   * Get the value of price
   */ 
  public function getPrice() : float
  {
    return $this->price;
  }

  /**
   * Get a copy of a given title
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

  public function addCopy()
  {
    $this->stock++;
  }
}