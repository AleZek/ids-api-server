<?php

namespace App\Controller;

use App\Entity\Arco;
use App\Entity\Beacon;
use App\Entity\Mappa;
use App\Utils\EmergencyNotifier;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    private $csvDir = '../csv';
    private $mappaRepo;
    private $beaconRepo;
    private $arcoRepo;

    /**
     * @Route("/admin/home", name="admin_main")
     */
    public function index(Request $request)
    {
        $emergencyForm = $this->createFormBuilder()
            ->add('emergency', SubmitType::class, array('label' => 'Gestione Emergenze'))
            ->setAction($this->generateUrl('admin_emergency'))
            ->setMethod('GET')
            ->getForm();
        $mapForm = $this->createFormBuilder()
            ->add('map', SubmitType::class, array('label' => 'Gestione API'))
            ->setAction('/api')
            ->setMethod('GET')
            ->getForm();
        $uploadForm = $this->createFormBuilder()
            ->add('upload', SubmitType::class, array('label' => 'Gestione Beacon'))
            ->setAction($this->generateUrl('admin_upload'))
            ->setMethod('GET')
            ->getForm();
        $logoutForm = $this->createFormBuilder()
            ->add('logout', SubmitType::class, array('label' => 'Logout'))
            ->setAction('/logout')
            ->setMethod('GET')
            ->getForm();

        return $this->render('admin/index.html.twig', array(
            'emergency' => $emergencyForm->createView(), 'map' => $mapForm->createView(),
            'upload' => $uploadForm->createView(),'logout' => $logoutForm->createView(),
        ));

    }


    /**
     * @Route("/admin/upload", name="admin_upload")
     */
    public function uploadCsv(Request $request)
    {

        $form = $this->createFormBuilder()
            ->add('beacon', FileType::class, array('label' => 'Csv Beacon'))
            ->add('archi', FileType::class, array('label' => 'Csv Archi'))
            ->add('save', SubmitType::class, array('label' => 'Upload'))
            ->getForm();

        $form->handleRequest($request);

        $gobackForm = $this->createFormBuilder()
                            ->add('back', SubmitType::class, array('label' => 'Indietro'))
                            ->setAction($this->generateUrl('admin_main'))
                            ->setMethod('GET')
                            ->getForm();

        $uploaded = 0;
        if ($form->isSubmitted()) {
            $beaconFile = $form['beacon']->getData();
            $beaconFile->move($this->csvDir, 'nodi.csv');
            $archiFile = $form['archi']->getData();
            $archiFile->move($this->csvDir, 'archi.csv');
            $uploaded = 1;

            $this->beaconRepo = $this->getDoctrine()->getRepository(Beacon::class);
            $this->mappaRepo = $this->getDoctrine()->getRepository(Mappa::class);
            $this->arcoRepo = $this->getDoctrine()->getRepository(Arco::class);

            $this->arcoRepo->deleteAll();
            $this->beaconRepo->deleteAll();

            $this->importNodi();
            $this->importArchi();

        }

        return $this->render('admin/upload_form.html.twig', array(
            'form' => $form->createView(), 'uploaded' => $uploaded, 'back' => $gobackForm->createView()
        ));
    }

    /**
     * @Route("/admin/emergency", name="admin_emergency")
     */
    public function emergency(Request $request)
    {
        $emergencyForm = $this->get('form.factory')->createNamedBuilder('emergency')
            ->add('send', SubmitType::class, array('label' => 'Lancia Emergenza'))
            ->setAction($this->generateUrl('admin_emergency'))
            ->setMethod('POST')
            ->getForm();
        $stopEmergencyForm = $this->get('form.factory')->createNamedBuilder('stop')
            ->add('stop', SubmitType::class, array('label' => 'Stop Emergenza'))
            ->setAction($this->generateUrl('admin_emergency'))
            ->setMethod('POST')
            ->getForm();
        $gobackForm = $this->createFormBuilder()
            ->add('back', SubmitType::class, array('label' => 'Indietro'))
            ->setAction($this->generateUrl('admin_main'))
            ->setMethod('GET')
            ->getForm();


        if ($request->request->has('emergency'))
            $emergencyForm->handleRequest($request);
        if($emergencyForm->isSubmitted() && !file_exists('emergency.lock')) {
            EmergencyNotifier::startEmergency();

            fopen("emergency.lock", "w");
        }
        if ($request->request->has('stop'))
            $stopEmergencyForm->handleRequest($request);
        if($stopEmergencyForm->isSubmitted() && file_exists('emergency.lock')) {
            EmergencyNotifier::stopNotification();
            unlink("emergency.lock");
        }



        return $this->render('admin/emergenza.html.twig', array(
            'emergency' => $emergencyForm->createView(), 'stop' => $stopEmergencyForm->createView(),
            'back' => $gobackForm->createView(), 'emergenza' => file_exists('emergency.lock'),
        ));
    }

    function importNodi(){
        $entityManager = $this->getDoctrine()->getManager();

        if( $fh = fopen($this->csvDir ."/nodi.csv","r")){

            while (($data = fgetcsv($fh, 1000, ",")) !== FALSE) {
                //estraggo un nodo
                $node = $this->buildNodo($data);
                $entityManager->persist($node);
            }
            $entityManager->flush();
        }
    }

    function importArchi(){
        $entityManager = $this->getDoctrine()->getManager();

        if( $fh = fopen($this->csvDir ."/archi.csv","r")){
            while (($data = fgetcsv($fh, 1000, ";")) !== FALSE) {
                //estraggo un arco
                $edge = $this->buildArco($data);
                $entityManager->persist($edge);
            }
            $entityManager->flush();
        }
    }

    function buildArco($data){
        $edge = new Arco();
        $begin = $this->beaconRepo->findOneBy(array("name" => $data[0]));
        $end = $this->beaconRepo->findOneBy(array("name" => $data[1]));
        $edge->setBegin($begin);
        $edge->setEnd($end);
        $edge->setStairs((int) $data[2]);
        if($data[3] != "" && $data[4]!="") {
            $edge->setLength((double) $data[4]);
            $edge->setWidth((double) $data[3]);
        }else {
            $edge->setLength($this->calculateDistance($begin, $end));
            $edge->setWidth($this->calculateWidth($begin, $end));
        }
        $edge->setV(0);
        $edge->setI(0);
        $edge->setC(0);
        $edge->setLos(0);

        return $edge;
    }



    function buildNodo($data){
        $node = new Beacon();
        $node->setName($data[0]);
        $node->setX((float) $data[1]);
        $node->setY((float) $data[2]);
        $node->setFloor((int) $data[3]);
        $node->setWidth((float) $data[4]);
        $node->setMeterx((float) $data[5]);
        $node->setMetery((float) $data[6]);
        $node->setType($data[7]);
        $node->setMappa($this->mappaRepo->find($data[8]));
        if(array_key_exists(9, $data))
            $node->setDevice(data[9]);

        return $node;
    }

    private function calculateDistance($begin, $end){
        $beginx = $begin->getMeterx();
        $endx = $end->getMeterX();
        $beginy = $begin->getMetery();
        $endy = $end->getMetery();
        $deltaX = $beginx - $endx;
        $deltaY = $beginy - $endy;

        return sqrt(($deltaX*$deltaX) + ($deltaY*$deltaY) );
    }

    private function calculateWidth($begin, $end){
        $beginWidth = $begin->getWidth();
        $endWidth = $end->getWidth();

        return ($beginWidth + $endWidth)/2;
    }

}
