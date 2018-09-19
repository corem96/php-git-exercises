<?php

use Bookstore\Core\Router;
use Bookstore\Core\Request;

require_once __DIR__ . '/vendor/autoload.php';


$router = new Router();
$req = new Request();

print("<pre>".print_r($req,true)."</pre>");

// $response = $router->route($req);
// echo $response;

// $loader = new Twig_Loader_Filesystem(__DIR__ . '\views');
// $twig = new Twig_Environment($loader);

// $bookModel = new BookModel(Db::getInstance());
// $books = $bookModel->getAll(1, 3);

// $params = ['book' => $books, 'currentPage' => 2];
// echo $twig->loadTemplate('books.twig')->render($params);

// $saleModel = new SaleModel(Db::getInstance());
// $sales = $saleModel->getByUser(1);

// $params = ['sales' => $sales];
// echo $twig->loadTemplate('sales.twig')->render($params);

// $saleModel = new SaleModel(Db::getInstance());
// $sale = $saleModel->get(1);

// $params = ['sale' => $sale];
// echo $twig->loadTemplate('sale.twig')->render($params);