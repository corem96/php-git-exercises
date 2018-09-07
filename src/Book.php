<?php

namespace Bookstore\Domain;

  class Book {
    private $isbn;
    private $title;
    private $author;
    private $available;
    private $price;

    public function __construct(int $isbn, string $title, string $author, int $price, int $available = 0)
    {
      $this->title = $title;
      $this->author = $author;
      $this->isbn = $isbn;
      $this->available = $available;
      $this->price = $price;
    }

    /**
     * Get the value of isbn
     */ 
    public function getIsbn() : int
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
     * Get the value of available
     */ 
    public function isAvailable() : bool
    {
        return $this->available;
    }
    
    public function addCopy()
    {
      $this->available++;
    }

    public function __toString() : string
    {
      $result = '<i>' . $this->title
        . '</i> - ' . $this->author;
        
        if (!$this->available) {
          $result .= '<b>Not available</b>';
        }
  
        return $result;
    }

    public function getCopy() : bool
    {
      if($this->available < 1){
        return false;
      }

      $this->available--;
      return true;
    }
  }
?>