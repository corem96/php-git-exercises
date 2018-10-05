<?php
/**
 * Book controller test class
 * PHP version 7.2
 *
 * @category Controller_Test
 * @package  Tests
 * @author   Jorge Escamilla <corem96@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/corem96/php-git-exercises
 */

namespace Bookstore\Tests\Controllers;

use Bookstore\Controllers\BookController;
use Bookstore\Core\Request;
use Bookstore\Exceptions\NotFoundException;
use Bookstore\Models\BookModel;
use Bookstore\Tests\ControllerTestCase;
use Twig_Template;

/**
 * Class for testing BookController
 *
 * @category Controller_Test
 * @package  Tests
 * @author   Jorge Escamilla <corem96@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/corem96/php-git-exercises
 */
class BookControllerTest extends ControllerTestCase
{
    /**
     * Creates a mock of the request to use if null is given.Bookstore.
     * Otherwise return a new BookController using the actual request
     *
     * @param Request $request The request foor testing
     * 
     * @return BookController A Mock of BookModel
     */
    private function _getController(Request $request = null): BookController
    {
        if ($request === null) {
            $request = $this->mock('Core\Request');
        }
        return new BookController($this->di, $request);
    }

    /**
     * Creates a mock of BookModel which expects NotFoundException value.
     * Then makes three more mocks after creating the BookModel:
     * the template for render with error message, the twig environment for preparing
     * the rendering with a error.twig template
     * and for last test result or assertion
     *
     * @return void
     */
    public function testBookNotFound()
    {
        $bookModel = $this->mock(BookModel::class);
        $bookModel
            ->expects($this->once())
            ->method('get')
            ->with(123)
            ->will(
                $this->throwException(new NotFoundException())
            );
        $this->di->set('BookModel', $bookModel);
        
        $response = "Rendered Template";
        $template = $this->mock(Twig_Template::class);
        $template
            ->expects($this->once())
            ->method('render')
            ->with(['errorMessage' => 'Book not found'])
            ->will($this->returnValue($response));
        $this->di->get('Twig_Environment')
            ->expects($this->once())
            ->method('loadTemplate')
            ->with('error.twig')
            ->will($this->returnValue($template));

        $resutl = $this->_getController()->borrow(123);

        $this->assertSame(
            $result,
            $response,
            'Response object is not the expected one'
        );
    }
}
