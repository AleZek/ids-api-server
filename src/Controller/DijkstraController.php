<?php

namespace App\Controller;

use App\Entity\Arco;
use App\Entity\Beacon;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DijkstraController extends Controller
{
    /**
     * @Route("/dijkstra", name="dijkstra")
     */
    public function index()
    {
        return $this->render('dijkstra/index.html.twig', [
            'controller_name' => 'DijkstraController',
        ]);
    }

    /**
     * @Route("/dijkstra/solve", name="dijkstra_solve",
     *        methods={"POST"})
     */
    public function solve(Request $request){
        $request_content = json_decode($request->getContent());
        $endpoints = $this->getEndpoints($request_content);
        $floor_nodes = $this->getFloorNodes($endpoints->begin_id);

    }

    private function getEndpoints($reuqestBody)
    {
        $begin_id = $reuqestBody->begin;
        $end_id = $reuqestBody->end;
        return (object) array("begin_id" => $begin_id, "end_id" => $end_id);
    }

    private function getFloorNodes($begin_id)
    {
        $beacon_repo = $this->getDoctrine()->getRepository(Beacon::class);
        $begin = $beacon_repo->find($begin_id);

        return $beacon_repo->findBy(array("floor" => $begin->getFloor()));
    }
}
