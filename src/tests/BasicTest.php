<?php

namespace Bookstore\Tests\Domain\Customer;

use Bookstore\Domain\Customer\Basic;
use PHPUnit_Framework_TestCase;

class BasicTest extends PHPUnit_Framework_TestCase {

    /**
     * Test for Basic customer
     *
     * @test
     */
    public function testAmountToBorrow()
    {
        $customer = new Basic(1, 'han', 'solo', 'hansolo@mail.com');

        $this->assertSame(
            3,
            $customer->getAmountToBorrow(),
            'Basic customer should borrow up to 3 books.'
        );
    }
}