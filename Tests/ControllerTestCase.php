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

/**
 * Abstract class for testing controllers
 *
 * @category Test_Extendible
 * @package  Tests
 * @author   Jorge Escamilla <corem96@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/corem96/php-git-exercises
 */
abstract class ControllerTestCase extends AbstracTestClass
{
    protected $di;

    /**
     * Sets up all dependencies for controllers using mock
     *
     * @return void
     */
    public function setUp()
    {
        $this->di = new DependecyInjector();;    
        $this->di->set('PDO', $this->mock(PDO::class));
        $this->di->set('Utils\Config', $this->mock(Config::class));
        $this->di->set('Twig_environment', $this->mock(Twig_Environment::class));
        $this->di->set('Logger', $this->mock(Logger::class));
    }
}
