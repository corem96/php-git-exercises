<?php

namespace Bookstore\Controllers;

use Bookstore\Exceptions\NotFoundException;
use Bookstore\Models\CustomerModel;

class CustomerController extends AbstractController {
    public function login(string $email) : string
    {
        if ($this->request->isPost()) {
            return $this->render('login.twig', []);
        }

        $params = $this->request->getParams();

        if (!$params->has('email')) {
            $opt = ['errorMessage' => 'No email provided!'];

            return $this->render('login.twig', $opt);
        }

        $email = $params->getString('email');
        $customerModel = new CustomerModel($this->db);

        try {
            $customer = $CustomerModel->getByEmail($email);
        } catch(NotFoundException $e) {
            $this->log->warn('Customer email not found: ' . $email);
            $params = ['errorMessage' => 'Email not found'];

            return $this->render('login.twig', $params);
        }

        setcookie('user', $customer->getId());

        $newController = newBookController($this->di, $this->request);
        
        return $newController->getAll();
    }
}