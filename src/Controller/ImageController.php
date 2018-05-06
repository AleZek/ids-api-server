<?php

namespace App\Controller;

use App\Entity\Beacon;
use App\Entity\Mappa;
use App\Utils\FileHelper;
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
            return new Response('{"img":"' . base64_encode($img_file) . '"}', 200);
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
            $this->updateMappaImgPath($id, $filename);

        $response_array = array("msg"   => "File Creato!",
                                "image" => $filename,
                                "id"    => $id,
                                "name"  => $this->getMappa($id)->getName());
        return new Response(json_encode($response_array), 200);
    }

    /**
     * @Route(
     *     name="delete_beacons_by_map",
     *     path="/api/mappas/{id}/beacons",
     *     methods={"DELETE"})
     *
     *
     */
    public function deleteBeaconsByMappa($id) {

        $mappa = $this->getMappa($id);
        foreach ($mappa->getBeacons() as $beacon){
            $this->deleteBeacon($beacon);
        }

        return new Response('{"msg":"beacon eliminati"}', 204);
    }

    /**
     * @Route(
     *     name="update_map_image",
     *     path="/api/image/map/{id}",
     *     methods={"PUT"})
     *
     * Nel corpo della Request voglio i dati dell'immagine in base64
     */
    public function updateMappaImage(Request $request, $id) {
        $request_data = $request->getContent();
        $json_data = json_decode($request_data);
        $data = base64_decode($json_data->image);
        $filename = $this->generateImgName($id);
        $fh = fopen(IMG_DIR . $filename, "w");
        if (fwrite($fh, $data))
            $this->deleteMappaImg($id);
            $this->updateMappaImgPath($id, $filename);

        $response_array = array("msg"   => "File Creato!",
            "image" => $filename,
            "id"    => $id,
            "name"  => $this->getMappa($id)->getName());
        return new Response(json_encode($response_array), 200);
    }

    public function deleteBeacon(Beacon $beacon)
    {
        if (!$beacon) {
            throw $this->createNotFoundException('Beacon non trovato');
        }

        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($beacon);
        $em->flush();
    }

    private function getMappa($id){
        $repository = $this->getDoctrine()
                           ->getRepository(Mappa::class);
        return $repository->find($id);
    }

    private function getImageFile($path){
        $fullPath = 'img/mappa/' . $path;
        if(!is_null($path) && file_exists($fullPath))
            return file_get_contents($fullPath);
        return null;
    }

    private function generateImgName($id){
        return $this->getMappa($id)->getName() . time() . ".jpg";
    }



    private function updateMappaImgPath($id, $filename){
        $mappa = $this->getMappa($id);
        $mappa->setImage($filename);
        $this->getDoctrine()->getManager()->flush();
    }

    private function deleteMappaImg($id){
        $mappa = $this->getMappa($id);
        $file = $mappa->getImage();
        $fh = new FileHelper('img/mappa/' . $file);
    }
}