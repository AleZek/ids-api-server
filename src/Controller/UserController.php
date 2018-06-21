<?php

namespace App\Controller;

use App\Entity\User;
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
        $preAuthToken = $this->jwtAuthenticator->getCredentials($request);

        return new Response(json_encode($preAuthToken), 200);
    }
}