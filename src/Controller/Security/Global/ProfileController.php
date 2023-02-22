<?php

namespace App\Controller\Security\Global;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController {
    #[Route('/profile', name: 'app.user.profile')]
    public function index(): Response {
        return $this->render('security/global/profile/index.html.twig', [
            'controller_name' => 'ProfileController',
        ]);
    }
}
