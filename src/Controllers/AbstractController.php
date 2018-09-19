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
 * An abstract controller class that manage configurations for db operations, views enviroments using Twig,
 * Loggin data into files and requests operations.
 */
abstract class AbstractController {
    protected $request;
    protected $db;
    protected $config;
    protected $view;
    protected $log;

    /**
     * Constructor of the AbstracController class
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->db = Db::getInstance();
        $this->config = Config::getInstance();

        $loader = new Twig_Loader_Filesystem(__DIR__ . '/../../views');
        $this->view = new Twig_Environment($loader);

        $this->log = new Logger('bookstore');
        $logFile = $this->config->get('log');
        $this->log->pushHandler(new StreamHandler($logFile, Logger::DEBUG));    
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
}