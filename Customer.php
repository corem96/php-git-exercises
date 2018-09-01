<?php

namespace Bookstore\Domain;

  class Customer {
    private $id;
    private $firstname;
    private $surname;
    private $email;
    private static $lastId = 0;

    public function __construct(int $id, string $firstname, string $surname, string $email)
    {
      $this->id = $id;
      $this->firstname = $firstname;
      $this->surname = $surname;
      $this->email = $email;
      if($id == null){
        $this->id = ++self::$lastId;
      } else {
        $this->id = $id;
        if ($id > self::$lastId) {
          self::$lastId = $id;
        }
      }
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of firstname
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Get the value of surname
     */ 
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    public static function getLastId() : int
    {
      return self::$lastId;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }
  }

?>