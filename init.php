<?php

  use Bookstore\Domain\Customer\CustomerFactory;
  use Bookstore\Domain\Customer;
  use Bookstore\Domain\Customer\Basic;
  use Bookstore\Domain\Customer\Premium;
  use Bookstore\Utils\Unique;
  use Bookstore\Domain\Person;
  use Bookstore\Domain\Book;
  use Bookstore\Utils\Config;
  use Bookstore\Exceptions\InvalidException;
  use Bookstore\Exceptions\NotFoundException;

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
  $config = Config::getInstance()->get('db');

  $db = new PDO(
    'mysql:host=127.0.0.1;dbname=financial',
    $dbConfig['user'],
    $dbConfig['password']
  );
  
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  $rows = $db->query('SELECT * FROM book ORDER BY title');
?>