<?php

namespace App\Controller;

use App\Entity\Beacon;
use App\Entity\Mappa;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MappaController extends Controller
{

    public function index() {}

    /**
     * @Route(
     *     name="delete_dati_mappa",
     *     path="/api/custom/mappas/{id}",
     *     methods={"DELETE"})
     */
    public function delete($id){
        $this->deleteBeaconsByMappa($id);
        $mappa = $this->getMappa($id);
        $this->deleteImgFile($mappa->getImage());
        $this->deleteMappa($mappa);
    }

    private function deleteBeaconsByMappa($id) {
        $mappa = $this->getMappa($id);
        foreach ($mappa->getBeacons() as $beacon){
            $this->deleteBeacon($beacon);
        }
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

    private function deleteImgFile($imageName){
        unlink('img/mappa/' . $imageName);
    }

    private function deleteMappa($mappa){
        if (!$mappa) {
            throw $this->createNotFoundException('Mappa non trovata');
        }
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($mappa);
        $em->flush();
    }


}
