<?php

namespace Strollad\PrestagesBundle\Controller;

use Strollad\PrestagesBundle\Entity\Client;
use Strollad\PrestagesBundle\Form\ClientType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ClientController extends Controller
{

    /**
     * @Route("/client/add", name="strollad_prestages_client_add", options={"expose"=true})
     */
    public function addAction(Request $request)
    {
        $client = new Client();
        $form       = $this->createForm(new ClientType(), $client);
        $form->handleRequest($request);
        $created = false;
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($client);
            $em->flush();
            $created = true;
            $template = 'Le nouveau client a été ajouté';
        } else {
            $template = $this->renderView('StrolladPrestagesBundle:Client:form.html.twig', array('form' => $form->createView()));
        }
        return new JsonResponse(array('html' => $template, 'created' => $created), 200);
    }
}
