<?php

namespace Bookstore\Controllers;

use Bookstore\Core\Config;
use Bookstore\Core\Db;
use Bookstore\Core\Request;
use Monolog\Logger;
use Twig_Environment;
use Twig_Loader_FileSystem;
use Monolog\Handler\StreamHandler;

/**
 * An abstract controller class that manage configurations for db operations, views enviroment,
 * Log data into files and requests operations.
 */
abstract class AbstractController {
    protected $request;
    protected $di;
    protected $db;
    protected $config;
    protected $view;
    protected $log;
    protected $customerId;

    /**
     * constructor of AbstractController that injects PDO, config, twig environment and logger dependencies.
     * Also gets customer ID from cookie
     * @param DependencyInjector $depinjector
     * @param Request $request
     */
    public function __construct(DependencyInjector $depinjector, Request $request)
    {
        $this->di = $depinjector;
        $this->request = $request;
        
        $this->db = $di->get('PDO');
        $this->config = $di->get('Utils\Config');
        $this->view = $di->get('Twig_Environment');
        $this->log = $di->get('Logger');
        
        $this->customerId = $_COOKIE['id'];
    }

    /**
     * A function that sets the customer ID
     *
     * @param integer $customerId
     * @return void
     */
    public function setCustomerId(int $customerId)
    {
        $this->customerId = $customerId;
    }

    /**
     * Page renderer using template and params to use within view
     *
     * @param string $template
     * @param array $params
     * @return twig
     */
    protected function render(string $template, array $params)
    {
        return $this->view->loadTemplate($template)->render($params);
    }
}