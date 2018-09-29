<?php

namespace Bookstore\Tests\Domain;

use Bookstore\Domain\Sale;
use PHPUnit\Framework\TestCase;
use Bookstore\Domain\Customer\CustomerFactory;

class SaleTest extends TestCase
{

    public function testNewSaleHasNoBooks() : void
    {
        $sale = new Sale();

        $this->assertEmpty(
            $sale->getBooks(),
            'When new, sale should have no books.'
        );
    }

    public function testAddNewBook()
    {
        $sale = new Sale();
        $sale->addBook(123);

        $this->assertCount(
            1,
            $sale->getBooks(),
            'Number of books not valid.'
        );

        $this->assertArrayHasKey(
            123,
            $sale->getBooks(),
            'When not specified, amount of books is 1.'
        );

        $this->assertSame(
            [123 => 1],
            $sale->getBooks(),
            'Book array does not match.'
        );
    }

    public function addMultipleBooks() : void
    {
        $sale = new Sale();
        $sale->addBook(123, 4);
        $sale->addBook(456, 2);
        $sale->addBook(456, 8);

        $this->assertSame(
            [123 => 4, 456 => 10],
            $sale->getBooks(),
            'Books are not as expected.'
        );
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Wrong type of customer
     */
    public function testCreatingWrongTypeOfCustomer() : void
    {
        $customer = CustomerFactory::factory('deluxe', 1, 'han', 'solo', 'han@solo.com');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testCreatingCorrectCustomer() : void
    {
        $customer = CustomerFactory::factory('basic', 1, 'han', 'solo', 'han@solo.com');
    }
}
