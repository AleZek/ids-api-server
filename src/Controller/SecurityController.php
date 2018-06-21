<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends Controller
{
    /**
     * @Route("/api/login", name="login")
     */
    public function login(Request $request)
    {
    }
    /**
     * @Route("/register", name="user_registration")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // 3) Encode the password (you could also do this via Doctrine listener)
        $request_content = $request->getContent();
        $request_content = json_decode($request_content);
        if (!is_null($request_content->nome) && !is_null($request_content->cognome) &&
            !is_null($request_content->email) && !is_null($request_content->password) ) {
            $user = new User();
//        var_dump($request_content);die;
            $user->setNome($request_content->nome);
            $user->setCognome($request_content->cognome);
            $user->setEmail($request_content->email);
            $user->setRoles('ROLE_USER');
            $password = $passwordEncoder->encodePassword($user, $request_content->password);
            $user->setPassword($password);

            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            //TODO Gestire utente già esistente etc

            return new Response(json_encode(array("email" => $user->getEmail() ,
                                                  "nome" => $user->getNome() ,
                                                  "cognome" => $user->getCognome())), 200);
        }

        return new Response("Bad Request", 400);
    }
}