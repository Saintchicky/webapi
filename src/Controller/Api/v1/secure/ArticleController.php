<?php

namespace App\Controller\Api\v1\secure;

use App\Shared\Globals;
use App\Repository\TArticleRepository;
use App\Repository\TCategorieRepository;
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
    private Globals $globals;
    private TArticleRepository $articleRepo;
    private TCategorieRepository $categorieRepo;

    public function __construct(Globals $globals, TArticleRepository $articleRepo, TCategorieRepository $categorieRepo)
    {
        $this->globals = $globals;
        $this->articleRepo = $articleRepo;
        $this->categorieRepo = $categorieRepo;
    }
    /**
     * @Route("articles", name="articles")
     */
    public function articles(): JsonResponse
    {
        return $this->globals->success([
            'articles' => array_map(function(TArticle $article){
                return $article->tojson();
            }, $this->articleRepo->findBy(['active' => true]))
        ]);
    }
}