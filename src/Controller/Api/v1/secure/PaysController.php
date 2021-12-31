<?php

namespace App\Controller\Api\v1\secure;

use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
/**
 * @Route("/api/v1/secure/pays")
 * @Security("is_granted('ROLE_AUTHOR')")
 */
class PaysController extends AbstractController
{
    
}