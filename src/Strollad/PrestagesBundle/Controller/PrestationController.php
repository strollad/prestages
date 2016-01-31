<?php

namespace Strollad\PrestagesBundle\Controller;

use Strollad\PrestagesBundle\Entity\Prestation;
use Strollad\PrestagesBundle\Form\PrestationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PrestationController extends Controller
{

    /**
     * @Route("/presta/add", name="strollad_prestages_prestation_add")
     */
    public function addAction(Request $request)
    {
        $prestation = new Prestation();
        $form       = $this->createForm(new PrestationType(), $prestation);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($prestation);
            $em->flush();
            return $this->redirectToRoute('strollad_prestages_homepage');
        }
        return $this->render('StrolladPrestagesBundle:Prestation:form.html.twig', array('title' => 'Ajouter la prestation', 'form' => $form->createView()));
    }

    /**
     * @Route("/presta/{id}/edit", name="strollad_prestages_prestation_edit", requirements = { "id" = "\d+" })
     */
    public function editAction($id, Request $request)
    {
        $em         = $this->getDoctrine()->getManager();
        $prestation = $em->getRepository('StrolladPrestagesBundle:Prestation')->find($id);
        if (!$prestation) {
            throw $this->createNotFoundException(
                'Pas de prestation avec cet id ' . $id
            );
        }
        $form = $this->createForm(new PrestationType(), $prestation);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('strollad_prestages_prestation_show', array('id' => $id));
        }
        return $this->render('StrolladPrestagesBundle:Prestation:form.html.twig', array('title' => 'Modifier la prestation', 'form' => $form->createView()));
    }

    /**
     * @Route("/presta/{id}/delete", name="strollad_prestages_prestation_delete", requirements = { "id" = "\d+" })
     */
    public function deleteAction($id)
    {
        $em         = $this->getDoctrine()->getManager();
        $prestation = $em->getRepository('StrolladPrestagesBundle:Prestation')->find($id);

        if (!$prestation) {
            throw $this->createNotFoundException(
                'Pas de prestation avec cet id ' . $id
            );
        }

        $em->remove($prestation);
        $em->flush();

        return $this->redirectToRoute('strollad_prestages_homepage');
    }

    /**
     * @Route("/presta/{id}/show", name="strollad_prestages_prestation_show", requirements = { "id" = "\d+" }, options={"expose"=true})
     */
    public function showAction($id, Request $request)
    {
        $em         = $this->getDoctrine()->getManager();
        $prestation = $em->getRepository('StrolladPrestagesBundle:Prestation')->find($id);
        if (!$prestation) {
            throw $this->createNotFoundException(
                'Pas de prestation avec cet id ' . $id
            );
        }
        return $this->render('StrolladPrestagesBundle:Prestation:show.html.twig', array('prestation' => $prestation));
    }
}
