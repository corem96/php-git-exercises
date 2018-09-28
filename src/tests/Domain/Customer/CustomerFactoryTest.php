<?php

namespace Bookstore\Tests\Domain\Customer;

use PHPUnit\Framework\TestCase;
use Bookstore\Domain\Customer\Basic;
use Bookstore\Domain\Customer\CustomerFactory;

class CustomerFactoryTest extends TestCase {
    public function testFactoryBasic() : void
    {
        $customer = CustomerFactory::factory(
            'basic', 1, 'han', 'solo', 'han@solo.com'
        );

        $this->assertInstanceOf(
            Basic::class,
            $customer,
            'Basic should create a Customer\Basic object.'
        );

        $expectedBasicCustomer = new Basic(1, 'han', 'solo', 'han@solo.com');

        $this->assertEquals(
            $customer,
            $expectedBasicCustomer,
            'Customer object is not as expected.'
        );
    }
}