<?php

namespace Bookstore\Models;

use Bookstore\Domain\Book;
use Bookstore\Exceptions\DbException;
use Bookstore\Exceptions\NotFoundException;


class BookModel extends AbstractModel{
  const CLASSNAME = '\Bookstore\Domain\Book';

  /**
   * Returns a single result of book by ID or a NotFoundException
   *
   * @param integer $id
   * @return Book
   */
  public function get(int $id) : Book
  {
    $query = 'SELECT * FROM book WHERE id = :id';
    $sth = $this->db->prepare($query);
    $sth->execute(['id' => $id]);
    
    $books = $sth->fetchAll(PDO::FETCH_CLASS, self::CLASSNAME);

    if(empty($books)){
      throw new NotFoundException();
    }

    return $books[0];
  }

  /**
   * Returns an array of limited books filtered by pages
   *
   * @param integer $page
   * @param integer $pageLength
   * @return array
   */
  public function getAll(int $page, int $pageLength) : array
  {
    $start = $pageLength * ($page - 1);

    $query = "SELECT * FROM book LIMIT :page, :length";
    $sth = $this->db->prepare($query);
    $sth->bindParam('page', $start, PDO::PARAM_INT);
    $sth->bindParam('length', $pageLength, PDO::PARAM_INT);
    $sth->execute();

    return $sth->fetchAll(PDO::FETCH_CLASS, self::CLASSNAME);
  }

  /**
   * Returns an array of all the books filtered by User ID
   *
   * @param integer $userId
   * @return array
   */
  public function getByUser(int $userId) : array
  {
    $query = "SELECT b.*
      FROM borrowed_books bb LEFT JOIN book b ON b.id = bb.book_id
      WHERE bb.customer_id = :id";
    $sth = $this->db->prepare($query);
    $sth->execute(['id' => $userId]);

    return $sth->fetchAll(PDO::FETCH_CLASS, self::CLASSNAME);
  }

  /**
   * Returns an array of all the books filtered by Title or Author
   *
   * @param string $title
   * @param string $author
   * @return array
   */
  public function search(string $title, string $author) : array
  {
    $query = "SELECT * FROM book WHERE title LIKE :title AND author LIKE :author";
    $sth = $this->db->prepare($query);
    $sth->bindValue('title', "%title%");
    $sth->bindValue('author', "%author%");

    return $sth->fetchAll(PDO::FETCH_CLASS, self::CLASSNAME);
  }

  /**
   * Inserts a new record of a book borrowed by a particular user
   *
   * @param Book $book
   * @param integer $userId
   * @return void
   */
  public function borrow(Book $book, int $userId)
  {
    $query = "INSERT INTO borrowed_books (book_id, customer_id, start)
        VALUES(:book, :user, NOW())";
    $sth = $this->bd->prepare($query);
    $sth->bindValue('book', $book);
    $sth->bindValue('customer_id', $userId);
    $sth->bindValue('user', $book);

    if (!$sth->execute()) {
      throw new DbException($sth->errorInfo()[2]);
    }

    $this->updateBookStock($book);
  }

  /**
   * Updates a record of a borrowed book by particular user and a null end date
   *
   * @param Book $book
   * @param integer $userId
   * @return void
   */
  public function returnBook(Book $book, int $userId)
  {
    $query = "UPDATE borrowed_books SET end = NOW()
      WHERE book_id = :book AND customer_id = :user AND end IS NULL";

    $sth = $this->db->prepare($query);
    $sth->bindValue('book', $book);
    $sth->bindValue('user', $userId);

    if (!$sth->execute()) {
      throw new DbException($sth->errorInfo()[2]);
    }

    $this->updateBookStock($book);
  }

  /**
   * Updates the stock of a particular book
   *
   * @param Book $book
   * @return void
   */
  private function updateBookStock(Book $book)
  {
    $query = "UPDATE book SET stock = :stock WHERE id = :book";
    $sth = $this->db->prepare($query);
    $sth->bindValue('id', $this->getId());
    $sth->bindValue('stock', $this->getStock());

    if (!$sth->execute()) {
      throw new DbException($sth->errorInfo()[2]);
    }
  }
}