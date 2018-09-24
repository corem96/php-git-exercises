<?php

namespace Bookstore\Controllers;

use Bookstore\Domain\Sale;
use Bookstore\Models\SaleModel;
use Bookstore\Exceptions\DbException;
use Bookstore\Exceptions\NotFoundException;

class SalesController extends AbstractController {
  public function add($id) : string
  {
    $bookId = (int)$id;
    $salesModel = new SaleModel($this->db);

    $sale = new Sale();
    $sale->setCustomerId($this->customerId);
    $sale->addBook($bookId);

    try {
      $salesModel->create($sale);
    } catch(\Exception $e) {
      $this->log->warn('Error buying book: ' . $e->getMessage());
      $properties = ['errorMessage' => 'error buying book'];

      return $this->render('error.twig', $properties);
    }

    return $this->getByUser();
  }

  public function getByUser() : string
  {
    $salesModel = new SalesModel($this->db);

    $sales = $salesModel->getByUser($this->customerId);

    $properties = ['sales' => $sales];

    return $this->render('sales.twig', $properties);
  }

  public function get($saleId) : string
  {
    $salesModel = new SalesModel($this->db);

    $sale = $salesModel->get($saleId);

    $properties = ['sale' => $sale];

    return $this->render('sale.twig', $properties);
  }
}