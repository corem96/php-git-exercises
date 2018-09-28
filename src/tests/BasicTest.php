<?php

namespace Bookstore\Tests\Domain\Customer;

use Bookstore\Domain\Customer\Basic;
use PHPUnit\Framework\TestCase;

final class BasicTest extends TestCase {

    /**
     * Test for Basic customer
     *
     * @test
     */
    public function testAmountToBorrow() : void
    {
        $customer = new Basic(1, 'han', 'solo', 'hansolo@mail.com');

        $this->assertSame(
            3,
            $customer->getAmountToBorrow(),
            'Basic customer should borrow up to 3 books.'
        );
    }
}