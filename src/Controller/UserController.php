<?php

namespace App\Controller;

use App\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Guard\JWTTokenAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends Controller
{
    /**
     * @Route("/api/user/locate", name="locate_user")
     */
    public function locateUser(Request $request)
    {
        //TODO  Estrai username da token
        $request = json_decode($request->getContent());
        $user_email = $request->email;
        $user_position = $request->position;

        $entityManager = $this->getDoctrine()->getManager();
        $userRepo = $entityManager->getRepository(User::class);
        $user = $userRepo->findBy(array("email" => $user_email ))[0];
        $user->setPosition($user_position);
        $entityManager->persist($user);

        $entityManager->flush();

        return new Response(json_encode(array("email" => $user->getEmail(),
                                              "position" => $user->getPosition())), 200);
    }
}