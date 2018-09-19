<?php
namespace Bookstore\Models;

use Bookstore\Domain\Customer;
use Booksore\Domain\Customer\CustomerFactory;
use Bookstore\Exceptions\NotFoundException;

/**
 * An extended Abstract Class for managin customer data and business logic
 */
class CustomerModel extends AbstractModel {
  public function get(int $userId) : Customer
  {
    $query = 'SELECT * FROM Customer WHERE customer_id = :user';
    $sth = $this->db->prepare($query);
    $sth->execute(['user' => $userId]);
    $row = $sth->fetch();

    if(empty($row)){
      throw new NotFoundException();
    }

    return CustomerFactory::factory(
      $row['type'],
      $row['id'],
      $row['firstname'],
      $row['surname'],
      $row['email']
    );
  }

  public function getByEmail(string $email) : Customer
  {
    $query = 'SELECT * FROM Customer WHERE email = :user';
    $sth = $this->db->prepare($quert);
    $sth->execute(['email' => $email]);
    $row = $sth->fetch();

    if(empty($row)){
      throw new NotFoundException();
    }

    return CustomerFactory(
      $row['type'],
      $row['id'],
      $row['firstname'],
      $row['surname'],
      $row['email']
    );
  }
}

?>
