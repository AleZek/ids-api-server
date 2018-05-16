<?php

namespace App\Controller;

use App\Entity\Arco;
use App\Entity\Beacon;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ArcoController extends \Symfony\Bundle\FrameworkBundle\Controller\Controller {

    public function __construct()
    {
    }

    /**
     * @Route(
     *     name="api_arco_insert",
     *     path="/api/server/arcos/",
     *     methods={"POST"})
     */
    public function insertArco(Request $request, $id) {
        $repository = $this->getDoctrine()
                           ->getRepository(Arco::class);
        $request_data = $request->getContent();
        $object_data = $this->acquireRequestData($request_data);
        $newArco = $repository->insert($object_data);

        return new Response(json_encode($newArco), 200);
    }

    private function getBeacon($id){
        $repository = $this->getDoctrine()
            ->getRepository(Beacon::class);
        return $repository->find($id);
    }

    private function parseBeaconId($iri){
        return str_replace("/api/beacons/", "", $iri);
    }

    private function calculateDistance($begin, $end){
        $beginx = $begin->getX();
        $endx = $end->getX();
        $beginy = $begin->getY();
        $endy = $end->getY();
        $deltaX = $beginx - $endx;
        $deltaY = $beginy - $endy;

        return sqrt(($deltaX*$deltaX) + ($deltaY*$deltaY) );
    }

    private function calculateWidth($begin, $end){
        $beginWidth = $begin->getWidth();
        $endWidth = $end->getWidth();

        return ($beginWidth + $endWidth)/2;
    }

    private function acquireRequestData($request_data){
        $json_data = json_decode($request_data);
        $beginId = $this->parseBeaconId($json_data->begin);
        $endId = $this->parseBeaconId($json_data->end);
        $begin = $this->getBeacon($beginId);
        $end = $this->getBeacon($endId);
        $json_data->length = $this->calculateDistance($begin,$end);
        $json_data->width = $this->calculateWidth($begin,$end);
        return $json_data;
    }
}