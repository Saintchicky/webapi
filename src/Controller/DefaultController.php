<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home():JsonResponse
    {
        return new JsonResponse('Bienvenue sur votre api rest symfo');
    }
}
