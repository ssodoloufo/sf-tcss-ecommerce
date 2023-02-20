<?php

namespace App\Controller\Session;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {
    #[Route('/home', name: 'app.home')]
    public function index(): Response {
        return $this->render('session/home.html.twig');
    }
}
