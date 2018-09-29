<?php

namespace Bookstore\Tests\Domain\Customer;

use PHPUnit\Framework\TestCase;
use Bookstore\Domain\Customer\Basic;
use Bookstore\Domain\Customer\CustomerFactory;

class CustomerFactoryTest extends TestCase {
    
    public function providerFactoryValidCustomerTypes() : array
    {
        return [
            'Basic customer, lowercase' => [
                'type' => 'basic',
                'expectedType' => '\Bookstore\Domain\Customer\Basic'
            ],
            'Basic customer, uppercase' => [
                'type' => 'BASIC',
                'expectedType' => '\Bookstore\Domain\Customer\Basic'
            ],
            'Premium customer, lowercase' => [
                'type' => 'premium',
                'expectedType' => '\Bookstore\Domain\Customer\Premium'
            ],
            'Premium customer, uppercase' => [
                'type' => 'PREMIUM',
                'expectedType' => '\Bookstore\Domain\Customer\Premium'
            ]
        ];
    }

    /**
     * @dataProvider providerFactoryValidCustomerTypes
     * @param string $type
     * @param string $expectedType
     */
    public function testFactoryValidCustomerType(string $type, string $expectedType) : void
    {
        $customer = CustomerFactory::factory($type, 1, 'han', 'solo', 'han@solo.com');
        
        $this->assertInstanceOf(
            $expectedType,
            $customer,
            'Factory created the wrong type of customer.'
        );
    }

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