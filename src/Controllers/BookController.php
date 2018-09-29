<?php

namespace Bookstore\Controllers;

use Bookstore\Models\BookModel;
use Bookstore\Exceptions\DbException;
use Bookstore\Exceptions\NotFoundException;

/**
 * Manages all book operations for fetching, storing and displaying book data
 */
class BookController extends AbstractController {
  const PAGE_LENGTH = 10;

  /**
   * Returns a twig page with all books and a particular page
   *
   * @param [type] $page
   * @return (string) twig rendered page
   */
  public function getAllWithPage($page) : string
  {
    $page = (int)$page;
    $bookModel = new BookModel($this->db);

    $books = $bookModel->getAll($page, self::PAGE_LENGTH);

    $properties = [
      'books' => $books,
      'currentPage' => $page,
      'lastPage' => count($books) < self::PAGE_LENGTH
    ];

    return $this->render('books.twig', $properties);
  }

  /**
   * Returns a twig page with all books in one page
   *
   * @return (string) twig rendered page
   */
  public function getAll() : string
  {
    return $this->getAllWithPage(1);
  }

  /**
   * Returns a twig page with a particular book model
   *
   * @param Book $bookId
   * @return (string) twig rendered page
   */
  public function get(Book $bookId) : string
  {
    $bookModel = new BookModel($this->db);

    try {
      $book = $bookModel->get($bookId);
    } catch(\Exception $e){
      $this->log->error('Error getting book: ' . $e->getMessage());
      $properties = ['errorMessage' => 'Book not found!'];
      
      return $this->render('error.twig', $properties);
    }

    $properties = ['book' => $book];

    return $this->render('book.twig', $properties);
  }

  /**
   * Returns a twig page with a list of all books borrowed to a logged in customer
   *
   * @return (string) twig rendered page
   */
  public function getByUser() : string
  {
    $bookModel = new BookModel($this->db);

    $books = $bookModel->getByUser($this->customerId);
    $properties = [
      'books' => $books,
      'currentPage' => 1,
      'lastPage' => true
    ];

    return $this->render('books.twig', $properties);
  }

  /**
   * Returns a twig page with a list of all books that user is searching by title and author
   *
   * @return (string) twig rendered page
   */
  public function search() : string
  {
    $title = $this->request->getParams()->getString('title');
    $author = $this->request->getParams()->getString('author');

    $bookModel = new BookModel($this->db);
    $books = $bookModel->search($title, $author);

    $properties = [
      'books' => $books,
      'currentPage' => 1,
      'lastPage' => true
    ];

    return $this->render('books.twig', $properties);
  }

  /**
   * Tries to borrow a particular book to logged in customer, if succeed
   * it updates the book stock decreasing it and returns a twig page with a list of all books borrowed to the customer including the new one
   *
   * @return (string) twig rendered page
   */
  public function borrow(int $bookId) : string
  {
    $bookModel = $this->di->get('BookModel');
    
    try {
      $book = $bookModel->get($bookId);
    } catch(NotFoundException $e){
      $this->log->warn('Book not found: ' . $bookId);
      $params = ['errorMessage' => 'Book not found'];
      
      return $this->render('book.twig', $params);
    }

    if (!$book->getCopy()) {
      $params = ['errorMessage' => 'there are no copies left.'];
      
      return $this->render('book.twig', $params);
    }

    try {
      $bookModel->borrow($book, $this->customerId);
    } catch(DbException $e) {
      $this->log->error('Error borrowing book: ' . $e->getMessage());
      $params = ['errorMessage' => 'Error borrowing book'];

      return $this->render('book.twig', $params);
    }

    return $this->getByUser();
  }
  
  /**
   * Tries to return a particular book, if succeed 
   * it updates the book stock increasing it and returns a twig page with a list of all borowed books to the logged in customer
   * @param integer $bookId
   * @return (string) twig rendered page
   */
  public function returnBook(int $bookId) : string
  {
    $bookModel = new BookModel($this->db);

    try {
      $book = $bookModel->get($bookId);
    } catch(NotFoundException $e) {
      $this->log->warn('Book not found' . $bookId);
      $params = ['errorMessage' => 'Book not found'];

      return $this->render('book.twig', $params);
    }

    $book->addCopy();

    try {
      $bookModel->returnBook($book, $this->customerId);
    } catch(DbException $e) {
      $this->log->error('Error returning book' . $e->getMessage());
      $params = ['errorMessage' => 'Error returning book'];

      return $this->render('book.twig', $params);
    }

    return $this->getByUser();
  }
}