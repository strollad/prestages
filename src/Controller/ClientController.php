<?php

namespace App\Controller;

use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Client;
use App\Form\ClientType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/client")
 */
class ClientController extends Controller
{
    /**
     * @Route("/", name="client_liste")
     */
    public function liste(ClientRepository $clients): Response
    {
        return $this->render('client/index.html.twig',
            ['clients' => $clients->findAll()]);
    }

    /**
     * @Route("/ajouter", name="client_ajouter", options={"expose"=true})
     */
    public function ajouter(Request $request, EntityManagerInterface $em): Response
    {
        $client = new Client();
        $form   = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);
        $created = false;
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($client);
            $em->flush();
            $created  = true;
            $template = 'Le nouveau client a été ajouté';
        } else {
            $template = $this->renderView('client/form.html.twig', ['form' => $form->createView()]);
        }
        return new JsonResponse(['html' => $template, 'created' => $created, 'organisation' => $client->getOrganisation(), 'id' => $client->getId()], 200);
    }


    /**
     * @Route("/{id}", name="client_voir", requirements = { "id" = "\d+" }, options={"expose"=true})
     */
    public function voir(Client $client)
    {
        return $this->render('client/show.html.twig', ['client' => $client]);
    }

}
