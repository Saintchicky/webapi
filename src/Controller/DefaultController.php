<?php

namespace App\Controller;

use App\Shared\Globals;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    public Globals $globals;
    
    public function __construct(Globals $globals)
    {
        $this->globals = $globals;
    }

    /**
     * @Route("/", name="home")
    */
    public function home(): JsonResponse
    {
        return $this->globals->success([], 'Bienvenue sur votre API Rest en symfony');
    }
    /**
     * @Route("/documentation", name="doc")
    */
    public function apiDoc(): JsonResponse
    {
        return $this->globals->success([
            'title' => "Api Documentation REST Full",
            'sous-titre' => [
                "login" => "Rest login",
                "logout" => "Rest logout",
                "register" => "Rest register",
            ]
        ]);
    }
}
