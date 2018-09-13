<?php
namespace Bookstore\Domain;

class Sale {
  private $id;
  private $customer_id;
  private $books;
  private $date;
  
  /**
   * Set customer ID value
   *
   * @param integer $customerId
   * @return void
   */
  public function setCustomerId(int $customerId) {
    $this->customer_id = $customerId;
  }
  
  /**
   * Set book value
   *
   * @param array $books
   * @return void
   */
  public function setBooks(array $books) {
    $this->books = $books;
  }
  
  /**
   * Returns value of ID
   *
   * @return integer
   */
  public function getId(): int {
    return $this->id;
  }
  
  /**
   * Returns value of customer ID
   *
   * @return integer
   */
  public function getCustomerId(): int {
    return $this->customer_id;
  }
  
  /**
   * Returns array of books
   *
   * @return array
   */
  public function getBooks(): array {
    return $this->books;
  }
  
  /**
   * Returns value of date
   *
   * @return string
   */
  public function getDate(): string {
    return $this->date;
  }
  
  /**
   * Increases a book quantity by a given amount when the book ID exists
   *
   * @param integer $bookId
   * @param integer $amount
   * @return void
   */
  public function addBook(int $bookId, int $amount = 1) {
    if (!isset($this->books[$bookId])) {
      $this->books[$bookId] = 0;
    }
    $this->books[$bookId] += $amount;
  }
}