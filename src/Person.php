<?php
  namespace Bookstore\Domain;

  use Bookstore\Utils\Unique;

  class Person {
    use Unique;
    
    protected $firsname;
    protected $surname;
    protected $email;

    public function __construct(int $id = null, string $firstname, string $surname, string $email)
    {
      $this->firstname = $firstname;
      $this->surname = $surname;
      $this->email = $email;
      $this->setId($id);
    }

    /**
     * Get the value of firsname
     */ 
    public function getFirsname() : string
    {
        return $this->firsname;
    }

    /**
     * Get the value of surname
     */ 
    public function getSurname() : string
    {
        return $this->surname;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail() : string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        // return $this;
    }
  }
?>