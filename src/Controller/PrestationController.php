<?php

namespace App\Controller;

use App\Entity\Prestation;
use App\Form\PrestationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/prestation")
 */
class PrestationController extends Controller
{

    /**
     * @Route("/ajouter", name="prestation_ajouter")
     */
    public function ajouter(Request $request, EntityManagerInterface $em)
    {
        $prestation = new Prestation();
        $form       = $this->createForm(PrestationType::class, $prestation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($prestation);
            $em->flush();
            return $this->redirectToRoute('homepage');
        }
        return $this->render('prestation/form.html.twig', ['title' => 'Ajouter la prestation', 'form' => $form->createView()]);
    }

    /**
     * @Route("/{id}/modifier", name="prestation_modifier", requirements = { "id" = "\d+" })
     */
    public function modifier(Request $request, Prestation $prestation, EntityManagerInterface $em)
    {
        $form = $this->createForm(PrestationType::class, $prestation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('prestation_voir', ['id' => $prestation->getId()]);
        }
        return $this->render('prestation/form.html.twig', ['title' => 'Modifier la prestation', 'form' => $form->createView()]);
    }

    /**
     * @Route("/{id}/supprimer", name="prestation_supprimer", requirements = { "id" = "\d+" })
     */
    public function supprimer(Prestation $prestation, EntityManagerInterface $em)
    {
        $em->remove($prestation);
        $em->flush();
        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/{id}", name="prestation_voir", requirements = { "id" = "\d+" }, options={"expose"=true})
     */
    public function voir(Prestation $prestation)
    {
        return $this->render('prestation/show.html.twig', ['prestation' => $prestation]);
    }
}
