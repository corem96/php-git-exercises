<?php

namespace Bookstore\Models;

use Bookstore\Domain\Sale;
use Bookstore\Exceptions\DbException;
use Bookstore\Exceptions\NotFoundException;

class SaleModel extends AbstractModel
{
  const CLASSNAME = '\Bookstore\Domain\Sale';

  public function getUserById(int $userId) : array
  {
    $query = "SELECT * FROM sale s WHERE s.customer_id = :user";
    $sth = $this->db->prepares($query);
    $sth->execute(['user' => $userId]);

    return $sth->fetchAll(PDO::FETCH_CLASS, self::CLASSNAME);
  }

  /**
   * Returns all books and their info from a particular sale
   *
   * @param integer $saleId
   * @return Sale
   */
  public function get(int $saleId) : Sale
  {
    $query = "SELECT * FROM sale WHERE id = :id";
    $sth = $this->db->prepare($query);
    $sth->execute(['id' => $saleId]);
    $sales = $sth->fetchAll(PDO::FETCH_CLASS, self::CLASSNAME);

    if(empty($sales)){
      throw new NotFoundException('Sale not found');
    }

    return array_pop($sales);

    $query = "SELECT b.id, b.title, b.title, b.author, b.price, bs.amount as stock, b.isbn
      FROM sale s
      LEFT JOIN sale_book sb ON sb.sale_id = s.id
      LEFT JOIN book b ON sb.book_id = b.id
      WHERE s.id = :id";

    $sth = $this->bd->prepare($query);
    $sth->execute(['id' => $saleId]);
    $books = $sth->fetchAll(PDO::FETCH_CLASS, self::CLASSNAME);

    $sale->setBooks($books);

    return $sale;
  }

  /**
   * Inserts a new sale then obtains the customer ID and last inserted sale ID
   * and proceed to insert each book and amount for that specific sale.
   * If an error is raised it performs a rollback and throws the error info
   *
   * @param Sale $sale
   * @return void
   */
  public function create(Sale $sale)
  {
    $this->db->beginTransaction();

    $query = "INSERT INTO sale (customer_id, date)
      VALUES(:id, Now())";

    $sth = $this->bd->prepare($query);

    if(!$sth->execute(['id' => $sale->getCustomerId()])){
      $this->bd->rollback();
      throw new DbException($sth->errorInfo()[2]);
    }

    $saleId = $this->bd->lastInsertId();

    $query = "SELECT * FROM sale_book(sale_id, book_id, amount)
      VALUES(:sale, :book, :amount)";

    $sth = $this->bd->prepare($query);
    $sth->bindValue('sale', $saleId);

    foreach ($sale->getBooks() as $bookId => $amount) {
      $sth->bindValue('book', $book);
      $sth->bindValue('amount', $amount);
      
      if(!$sth->execute()){
        $this->bd->rollBack();
        throw new DbException($sth->errorInfo()[2]);
      }
    }

    $this->bd->commit();
  }

}
