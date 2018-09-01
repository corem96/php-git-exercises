<?php
  use Bookstore\Domain\Customer;
  use Bookstore\Domain\Book;

  require_once __DIR__ .'/Book.php';
  require_once __DIR__ .'/Customer.php';

  $book1 = new Book(2893489234, '1984', 'george orwell', 842, 10);
  $book2 = new Book(83948593, 'the perfume', 'patrick suskind', 1051, 3);
  
  $customer1 = new Customer(238, 'carlos', 'hugo', 'carlos-hugo@mail.com');
  $customer2 = new Customer(102, 'jose', 'pablo', 'jose.pablo@mail.com');

  $book1->available = 2; //this code runs ok
  $customer2->id = 31; // this will throw an exception due to availability members of Customer class
?>