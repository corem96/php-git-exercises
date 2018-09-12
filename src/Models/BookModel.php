<?php

namespace Bookstore\Models;

use Bookstore\Domain\Book;
use Bookstore\Exceptions\DbException;
use Bookstore\Exceptions\NotFoundException;


class BookModel extends AbstractModel{
  const CLASSNAME = '\Bookstore\Domain\Book';

  public function get(int $id) : Book
  {
    $query = 'SELECT * FROM Book WHERE id = :id';
    $sth = $this->db->prepare($query);
    $sth->execute(['id' => $id]);
    
    $books = $sth->fetchAll(PDO::FETCH_CLASS, self::CLASSNAME);

    if(empty($books)){
      throw new NotFoundException();
    }

    return $books[0];
  }
}