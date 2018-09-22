<?php

namespace Bookstore\Controllers;

/**
 * Display a Not Found error message withing rendered twig page
 */
class ErrorController extends AbstractController {
    
    public function notFound(string $url) : string
    {
        $properties = ['errorMessage' => 'Page not found!', 'url' => $url];
        
        return $this->render('error.twig', $properties);
    }
}