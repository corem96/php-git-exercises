<?php
  use Bookstore\Domain\Customer;
  use Bookstore\Domain\Customer\Basic;
  use Bookstore\Domain\Customer\Premium;
  use Bookstore\Utils\Unique;
  use Bookstore\Domain\Person;
  use Bookstore\Domain\Book;
  use Bookstore\Exceptions\InvalidException;

  function autoloader($classname)
  {
    $lastSlash = strpos($classname, '\\') + 1;
    $classname = substr($classname, $lastSlash);
    $directory = str_replace('/', '\\', $classname);
    $directory = str_replace('Domain\\', '', $classname);
    $filename = __DIR__ . '\\src\\' . $directory . '.php';
    require_once($filename);
  }
  spl_autoload_register('autoloader');

  $pageTitle = 'PHP Clean Code with OOP';
  
  function checkIfValid(Customer $customer, array $books) : bool
  {
    return $customer->getAmountToBorrow() >= count($books);  
  }

  $basic = new Basic(1, "name", "surname", "email");

  try {
    $premium = new Premium(null, "name", "surname", "email");
  } catch(Exception $e) {
    echo "<code>something went wrong..." . $e->getMessage() . '</code>';
  }

  // $book1 = new Book(2893489234, '1984', 'george orwell', 842, 10);
  // $book2 = new Book(83948593, 'the perfume', 'patrick suskind', 1051, 3);

  // $customer1 = new Basic(238, 'carlos', 'hugo', 'carlos-hugo@mail.com');
?>