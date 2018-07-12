<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    /**
     * @Route("/api/login", name="login")
     */
    public function login(Request $request)
    {
    }
    /**
     * @Route("/login/admin", name="login_admin")
     */
    public function loginAdmin(Request $requestAuthenticationUtils, AuthenticationUtils $authenticationUtils)
{


    // get the login error if there is one
    $error = $authenticationUtils->getLastAuthenticationError();

    // last username entered by the user
    $lastUsername = $authenticationUtils->getLastUsername();

    return $this->render('security/login.html.twig', array(
        'last_username' => $lastUsername,
        'error'         => $error,
    ));
    }
    /**
     * @Route("/register", name="user_registration")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // 3) Encode the password (you could also do this via Doctrine listener)
        $request_content = $request->getContent();
        $request_content = json_decode($request_content);
        $em = $this->getDoctrine()->getRepository(User::class);
        if (!is_null($request_content->email) && !is_null($request_content->password) ) {
            if (!is_null($em->findOneBy(array("email" => $request_content->email)))) {
                $user = new User();
                $user->setEmail($request_content->email);
                $user->setRoles('ROLE_USER');
                $password = $passwordEncoder->encodePassword($user, $request_content->password);
                $user->setPassword($password);

                // 4) save the User!
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();

                //TODO Gestire utente già esistente etc

                return new Response(json_encode(array("email" => $user->getEmail())), 200);
            }else
                return new Response(json_encode(array("error" => $request_content->email . ' già presente.')), 409);
        }else
            return new Response("Bad Request", 400);
    }
}