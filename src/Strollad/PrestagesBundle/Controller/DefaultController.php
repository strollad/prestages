<?php

namespace Strollad\PrestagesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $prestations = $this->getDoctrine()
            ->getRepository('StrolladPrestagesBundle:Prestation')
            ->findAll();
        return $this->render('StrolladPrestagesBundle:Default:index.html.twig', array('prestations' => $prestations));
    }
}
