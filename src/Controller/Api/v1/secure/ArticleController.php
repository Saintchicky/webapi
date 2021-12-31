<?php

namespace App\Controller\Api\v1\secure;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/api/v1/secure/")
 * @Security("is_granted('ROLE_AUTHOR')")
 */
class ArticleController extends AbstractController
{
    /**
     * @Route("articles", name="articles")
     */
    public function articles():JsonResponse
    {
        return new JsonResponse([
            'articles'=>[]
        ]);
    }
}