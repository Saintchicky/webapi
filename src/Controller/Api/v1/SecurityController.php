<?php

namespace App\Controller\Api\v1;

use App\Entity\TUser;
use App\Shared\Globals;
use App\Repository\TPaysRepository;
use App\Repository\TUserRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

class SecurityController extends AbstractController
{
    // pr typer les proprietés cette fonction est dispo qu'à partir de la V php 7.4
    private Globals $globals;
    private TPaysRepository $paysRepo;
    private TUserRepository $userRepo;

    public function __construct(Globals $globals, TPaysRepository $paysRepo, TUserRepository $userRepo)
    {
        $this->globals = $globals;
        $this->paysRepo = $paysRepo;
        $this->userRepo = $userRepo;
    }
    /**
    * @Route("/login", name="login", methods = {"POST", "HAED"})
    */
    public function login(UserPasswordEncoderInterface $encoder, JWTTokenManagerInterface $token):JsonResponse
    {
        $data = $this->globals->jsondecode();
        if(!isset(
            $data->username,
            $data->password
        )) return new JsonResponse('form invalid',500);
        $user = $this->userRepo->findOneBy(['username'=>$data->username]);
        if(!$user) return new JsonResponse('username not found',500);
        if(!$encoder->isPasswordValid($user, $data->password))
            return new JsonResponse('password not valid',500);
        return new JsonResponse([
            'username' => $user->getUsername(),
            'token' => $token->create($user)
        ]);
    }
    /**
    * @Route("/register", name="register", methods = {"POST", "HAED"})
    */
    public function register(UserPasswordEncoderInterface $encoder):JsonResponse
    {
        $data = $this->globals->jsondecode();
        if(!isset(
            $data->username,
            $data->firstname,
            $data->lastname,
            $data->password,
            $data->fk_pays
        )) return new JsonResponse('error',500);
        // peut prendre plusieurs paramètre findOneBy
        $fk_pays = $this->paysRepo->findOneBy(['id'=>$data->fk_pays, 'active' => true]);
        $user = (new TUser())
                ->setActive(true)
                ->setUsername($data->username)
                ->setFirstname($data->firstname)
                ->setLastname($data->lastname)
                ->setFkPays($fk_pays)
                ->setDateSave(new \DateTime());

        $user->setPassword($encoder->encodePassword($user,$data->password));
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        return new JsonResponse('register successful !');
    }
}