<?php

namespace Bookstore\Tests\Domain\Customer;

use Bookstore\Domain\Customer\Basic;
use PHPUnit\Framework\TestCase;

final class BasicTest extends TestCase {

    public function setUp() : void
    {
        $this->customer = new Basic(1, 'han', 'solo', 'han@solo.com');
    }

    public function testIsExemptOfTaxes() : void
    {
        $this->assertFalse(
            $this->customer->isExtentOfTaxes(),
            'Basic customer should be exempt of taxes.'
        );
    }

    public function testGetMonthlyFee() : void
    {
        $this->assertSame(
            5,
            $this->customer->getMonthlyFee(),
            'Basic customer should pay 5 a month.'
        );
    }

    /**
     * Test for Basic customer
     *
     * @test
     */
    public function testAmountToBorrow() : void
    {
        $this->assertSame(
            3,
            $this->customer->getAmountToBorrow(),
            'Basic customer should borrow up to 3 books.'
        );
    }

    public function testFail() : void
    {
        $customer = new Basic(1, 'ban', 'solo', 'han@solo.com');

        $this->assertSame(
            4,
            $customer->getAmountToBorrow(),
            'Basic customer should borrow up to 3 books.'
        );
    }
}