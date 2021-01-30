<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Trucks;
use App\Entity\Mechanics;


class TrucksController extends AbstractController
{
    #[Route('/trucks', name: 'trucks_index', methods:['GET'])]
    public function index(): Response
    {
        $trucks = $this->getDoctrine()->
        getRepository(Trucks::class)->
        findAll();

        return $this->render('trucks/index.html.twig', [
            'trucks' => $trucks,
        ]);
    }

    #[Route('/trucks/create', name: 'trucks_create', methods:['GET'])]
    public function create(): Response
    {
        $mechanics = $this->getDoctrine()->
        getRepository(Mechanics::class)->
        findAll();

        return $this->render('trucks/create.html.twig',[
            'mechanics'=>$mechanics,
        ]);
    }
    
    #[Route('/trucks/store', name: 'trucks_store', methods:['POST'])]
    public function store(Request $r): Response
    {
        $mech = $this->getDoctrine()->
        getRepository(Mechanics::class)->
        find($r->request->get('truck_mechanic'));

        $trucks = new Trucks;
        $trucks->
        setMaker($r->request->get('truck_maker'))->
        setPlate($r->request->get('truck_plate'))->
        setMakeYear($r->request->get('truck_year'))->
        setMechanicNotices($r->request->get('truck_notice'))->
        setMechanic($mech);

        $enitytManager = $this->getDoctrine()->getManager();
        $enitytManager->persist($trucks);
        $enitytManager->flush();

        return $this->redirectToRoute('trucks_index');
    }
    #[Route('/trucks/edit/{id}', name: 'trucks_edit', methods:['GET'])]
    public function edit(int $id): Response
    {      
        $truck = $this->getDoctrine()->
        getRepository(Trucks::class)->
        find($id);

        $mechanics = $this->getDoctrine()->
        getRepository(Mechanics::class)->
        findAll();

        return $this->render('trucks/edit.html.twig',[
            'truck' =>$truck,
            'mechanics' =>$mechanics
        ]);
    }
    #[Route('/trucks/update/{id}', name: 'trucks_update', methods:['POST'])]
    public function update(Request $r,$id): Response
    {
        $truck = $this->getDoctrine()->
        getRepository(Trucks::class)->
        find($id);
        $mech = $this->getDoctrine()->
        getRepository(Mechanics::class)->
        find($r->request->get('truck_mechanic'));

        $truck->
        setMaker($r->request->get('truck_maker'))->
        setPlate($r->request->get('truck_plate'))->
        setMakeYear($r->request->get('truck_year'))->
        setMechanicNotices($r->request->get('truck_notice'))->
        setMechanic($mech);

        $enitytManager = $this->getDoctrine()->getManager();
        $enitytManager->persist($truck);
        $enitytManager->flush();

        return $this->redirectToRoute('trucks_index');
    }
    #[Route('/trucks/delete/{id}', name: 'trucks_delete',methods:['POST'])]
    public function delete(Request $r, $id): Response
    {
        $truck = $this->getDoctrine()->
        getRepository(Trucks::class)->
        find($id);

        

        $enitytManager = $this->getDoctrine()->getManager();
        $enitytManager->remove($truck);
        $enitytManager->flush();

        return $this->redirectToRoute('trucks_index');

    }


}
