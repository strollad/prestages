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
    public function homepage(PrestationRepository $prestations)
    {
        return $this->render('default/index.html.twig',
            ['prestations' => $prestations->findAll(), 'taches' => []]);
    }

    /**
     * @Route("/mon-profil", name="mon_profil")
     */
    public function monProfil(TokenStorageInterface $token)
    {
        return $this->render('default/mon-profil.html.twig', ['me' => $token->getToken()->getUser()]);
    }
}
