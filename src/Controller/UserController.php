<?php

namespace App\Controller;

use App\Entity\Arco;
use App\Entity\Position;
use App\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Guard\JWTTokenAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends Controller
{
    const DECREASE = 0;
    const INCREASE = 1;

    /**
     * @Route("/api/user/locate", name="locate_user")
     */
    public function locateUser(Request $request)
    {
        //TODO  Estrai username da token
        $request = json_decode($request->getContent());
        $user_email = $request->email;
        $newPosition = $request->position;

        $oldPosition = $this->updateUserPosition($user_email,$newPosition);

        $this->updateArchiLos($oldPosition, self::DECREASE);
        $this->updateArchiLos($newPosition, self::INCREASE);

        return new Response(json_encode(array("email" => $user_email,
                                              "position" => $newPosition)), 200);
    }

    private function updateArchiLos($position, $mode)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $archiRepo = $entityManager->getRepository(Arco::class);

        $archiBegin = $archiRepo->findBy(array("begin" => $position));
        $archiEnd = $archiRepo->findBy(array("end" => $position));

        if ($mode == self::DECREASE){
            $this->decreaseLos($archiBegin, $archiEnd, $entityManager);
        }else if ($mode == self::INCREASE){
            $this->increaseLos($archiBegin,$archiEnd, $entityManager);
        }
    }

    private function updateUserPosition($email, $newPosition)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $positionRepo = $entityManager->getRepository(Position::class);

        $position = $positionRepo->findBy(array("user" => $email ));
        $oldPosition = 0;
        if(count($position) > 0) {
            $position = $position[0];
            $oldPosition = $position->getBeacon();
            $position->setBeacon($newPosition);
        } else{
            $position = new Position();
            $position->setUser($email);
            $position->setBeacon($newPosition);
        }
        $entityManager->persist($position);
        $entityManager->flush();

        return $oldPosition;
    }

    private function decreaseLos($archiBegin, $archiEnd, $entityManager)
    {
        foreach ($archiBegin as $arco) {

            $arco->decreaseLos();
            $entityManager->persist($arco);
            $entityManager->flush();
        }
        foreach ($archiEnd as $arco) {
            $arco->decreaseLos();
            $entityManager->persist($arco);
            $entityManager->flush();
        }
    }

    private function increaseLos($archiBegin, $archiEnd, $entityManager)
    {
        foreach ($archiBegin as $arco) {
            $arco->increaseLos();
            $entityManager->persist($arco);
            $entityManager->flush();
        }
        foreach ($archiEnd as $arco) {
            $arco->increaseLos();
            $entityManager->persist($arco);
            $entityManager->flush();
        }
    }


}