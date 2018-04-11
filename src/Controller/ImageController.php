<?php

namespace App\Controller;

use App\Entity\Mappa;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

define('IMG_DIR', "img/mappa/");

class ImageController extends \Symfony\Bundle\FrameworkBundle\Controller\Controller {



    public function __construct()
    {

    }

    /**
     * @Route(
     *     name="retrieve_map_image",
     *     path="/api/image/map/{id}",
     *     methods={"GET"})
     */
    public function getMappaImage($id) {
        $mappa = $this->getMappa($id);
        $img_file = null;

        if (!is_null($mappa))
            $img_file = $this->getImageFile($mappa->getImage());

        if (!is_null($img_file))
            return new Response(base64_encode($img_file), 200);
        else
            return new Response($this->json(null), 200);
    }

    /**
     * @Route(
     *     name="write_map_image",
     *     path="/api/image/map/{id}",
     *     methods={"POST"})
     */
    public function createMappaImageFile($id) {
        $encoded_img = http_get_request_body();
        $data = base64_decode($encoded_img);
        $fh = fopen($this->generateImgName($id), "w");
        fwrite($fh, $data);
    }





    public function getFileImmagine(){}

    private function getMappa($id){
        $repository = $this->getDoctrine()
            ->getRepository(Mappa::class);

        return $repository->find($id);
    }

    private function getImageFile($path){
        return file_get_contents($path);
    }

    private function generateImgName($id){

        return $this->getMappa($id)->getName() . time() . ".jpg";

    }
}