<?php

namespace Bookstore\Controllers;

use Bookstore\Models\BookModel;

/**
 * Manages all book operations for fetching, storing and displaying book data
 */
class BookController extends AbstractController {
  const PAGE_LENGTH = 10;

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

  public function getAll() : string
  {
    return $this->getAllWithPage(1);
  }

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
}