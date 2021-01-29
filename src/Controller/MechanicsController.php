<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Mechanics;

class MechanicsController extends AbstractController
{
    #[Route('/mechanics', name: 'mechanics_index', methods:['GET'])]
    public function index(): Response
    {
        $mechanics = $this->getDoctrine()->
        getRepository(Mechanics::class)->
        findAll();

        return $this->render('mechanics/index.html.twig', [
            'mechanics' => $mechanics,
        ]);
    }

    #[Route('/mechanics/create', name: 'mechanics_create',methods:['GET'])]
    public function create(): Response
    {
        return $this->render('mechanics/create.html.twig');
    } 

    #[Route('/mechanics/store', name: 'mechanics_store',methods:['POST'])]
    public function store(Request $r): Response
    {
        $mech = new Mechanics;
        $mech->
        setName($r->request->get('mech_name'))->
        setSurname($r->request->get('mech_surname'));

        $enitytManager = $this->getDoctrine()->getManager();
        $enitytManager->persist($mech);
        $enitytManager->flush();

        return $this->redirectToRoute('mechanics_index');

    }
    #[Route('/mechanics/edit/{id}', name: 'mechanics_edit',methods:['GET'])]
    public function edit(int $id): Response
    {
        $mech = $this->getDoctrine()->
        getRepository(Mechanics::class)->
        find($id);

        return $this->render('mechanics/edit.html.twig',[
            'mech' => $mech,
        ]);

    }
        #[Route('/mechanics/update/{id}', name: 'mechanics_update',methods:['POST'])]
    public function update(Request $r, $id): Response
    {
        $mech = $this->getDoctrine()->
        getRepository(Mechanics::class)->
        find($id);

        $mech->
        setName($r->request->get('mech_name'))->
        setSurname($r->request->get('mech_surname'));

        $enitytManager = $this->getDoctrine()->getManager();
        $enitytManager->persist($mech);
        $enitytManager->flush();

        return $this->redirectToRoute('mechanics_index');

    }
    #[Route('/mechanics/delete/{id}', name: 'mechanics_delete',methods:['POST'])]
    public function delete(Request $r, $id): Response
    {
        $mech = $this->getDoctrine()->
        getRepository(Mechanics::class)->
        find($id);


        $enitytManager = $this->getDoctrine()->getManager();
        $enitytManager->remove($mech);
        $enitytManager->flush();

        return $this->redirectToRoute('mechanics_index');

    }

    
}
