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

}
