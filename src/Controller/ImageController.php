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
     *
     * Nel corpo della Request voglio i dati dell'immagine in base64
     */
    public function createMappaImageFile(Request $request, $id) {
        $request_data = $request->getContent();
        $json_data = json_decode($request_data);
        $data = base64_decode($json_data->image);
        $filename = $this->generateImgName($id);
        $fh = fopen(IMG_DIR . $filename, "w");
        if (fwrite($fh, $data))
            $this->updateMappaImg($id, $filename);
        return new Response($this->json("{\"msg\":\"File Creato!\"}"), 200);
    }

    private function getMappa($id){
        $repository = $this->getDoctrine()
                           ->getRepository(Mappa::class);
        return $repository->find($id);
    }

    private function getImageFile($path){
        if(!is_null($path))
            return file_get_contents($path);
        return null;
    }

    private function generateImgName($id){
        return $this->getMappa($id)->getName() . time() . ".jpg";
    }



    private function updateMappaImg($id, $filename){
        $mappa = $this->getMappa($id);
        $mappa->setImage($filename);
        $this->getDoctrine()->getManager()->flush();
    }
}