<?php
/**
 * General controller tester for other controllers to extends
 * PHP version 7.2
 *
 * @category Test_Extendible
 * @package  Tests
 * @author   Jorge Escamilla <corem96@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/corem96/php-git-exercises
 */
namespace Bookstore\Tests;

use PDO;
use Monolog\Logger;
use Twig_Environment;
use Bookstore\Core\Config;
use Bookstore\Tests\AbstractTestClass;
use Bookstore\Utils\DependencyInjector;

/**
 * Abstract class for testing controllers
 *
 * @category Test_Extendible
 * @package  Tests
 * @author   Jorge Escamilla <corem96@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/corem96/php-git-exercises
 */
abstract class ControllerTestCase extends AbstractTestClass
{
    protected $di;

    /**
     * Sets up all dependencies for controllers using mock
     *
     * @return void
     */
    public function setUp()
    {
        $this->di = new DependencyInjector();  
        $this->di->set('PDO', $this->mock(PDO::class));
        $this->di->set('Utils\Config', $this->mock(Config::class));
        $this->di->set('Twig_Environment', $this->mock(Twig_Environment::class));
        $this->di->set('Logger', $this->mock(Logger::class));
    }
}
