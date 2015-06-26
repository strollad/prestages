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

    /**
     * @Route("/mon-profil", name="strollad_prestages_myprofil")
     */
    public function monProfilAction()
    {
        $me = $this->get('security.token_storage')->getToken()->getUser();
        return $this->render('StrolladPrestagesBundle:Default:mon-profil.html.twig', array('me' => $me));
    }
}
