<?php

namespace App\Controller;

use App\Repository\PrestationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Route("/", name="strollad_prestages_homepage")
     */
    public function indexAction(PrestationRepository $prestations)
    {
        return $this->render('default/index.html.twig',
            ['prestations' => $prestations->findAll(), 'taches' => array()]);
    }

    /**
     * @Route("/mon-profil", name="strollad_prestages_myprofil")
     */
    public function monProfilAction(TokenStorageInterface $token)
    {
        return $this->render('default/mon-profil.html.twig', array('me' => $token->getToken()->getUser()));
    }
}
