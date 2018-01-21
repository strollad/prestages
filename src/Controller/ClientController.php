<?php

namespace App\Controller;

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
        return new JsonResponse(['html' => $template, 'created' => $created], 200);
    }
}
