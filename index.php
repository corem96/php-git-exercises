<?php

use Bookstore\Core\Db;;
use Bookstore\Models\BookModel;
use Bookstore\Models\SaleModel;

require_once __DIR__ . '/vendor/autoload.php';

$loader = new Twig_Loader_Filesystem(__DIR__ . '\views');
$twig = new Twig_Environment($loader);

$bookModel = new BookModel(Db::getInstance());
$books = $bookModel->getAll(1, 3);

$params = ['book' => $books, 'currentPage' => 2];
echo $twig->loadTemplate('books.twig')->render($params);

$saleModel = new SaleModel(Db::getInstance());
$sales = $saleModel->getByUser(1);

$params = ['sales' => $sales];
echo $twig->loadTemplate('sales.twig')->render($params);