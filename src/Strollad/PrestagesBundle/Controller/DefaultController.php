<?php

namespace Strollad\PrestagesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="strollad_prestages_homepage")
     */
    public function indexAction()
    {
        $prestations = $this->getDoctrine()
            ->getRepository('StrolladPrestagesBundle:Prestation')
            ->findAll();
        return $this->render('StrolladPrestagesBundle:Default:index.html.twig', array('prestations' => $prestations));
    }
}
