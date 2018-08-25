<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/utilisateur")
 */
class UtilisateurController extends Controller
{
    /**
     * @Route("/", name="utilisateur_liste")
     */
    public function liste(UtilisateurRepository $utilisateurs): Response
    {
        return $this->render('utilisateur/index.html.twig',
            ['utilisateurs' => $utilisateurs->findAll()]);
    }

    /**
     * @Route("/{id}", name="utilisateur_voir", requirements = { "id" = "\d+" }, options={"expose"=true})
     */
    public function voir(Utilisateur $utilisateur)
    {
        return $this->render('utilisateur/show.html.twig', ['utilisateur' => $utilisateur]);
    }

    /**
     * @Route("/ajouter", name="utilisateur_ajouter")
     */
    public function ajouter(Request $request, EntityManagerInterface $em): Response
    {

    }

    /**
     * @Route("/{id}/modifier", name="utilisateur_modifier", requirements = { "id" = "\d+" })
     */
    public function modifier(Request $request, Utilisateur $utilisateur, EntityManagerInterface $em): Response
    {
        $roles = array_keys($this->container->getParameter('security.role_hierarchy.roles'));
        $form = $this->createForm(UtilisateurType::class, $utilisateur, array('available_roles' => $roles));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('utilisateur_voir', ['id' => $utilisateur->getId()]);
        }
        return $this->render('utilisateur/form.html.twig', ['title' => 'Modifier l\'utilisateur', 'form' => $form->createView()]);
    }

    /**
     * @Route("/{id}/generer_password", name="utilisateur_generer_password", requirements = { "id" = "\d+" })
     */
    public function genererPassword(Utilisateur $utilisateur, EntityManagerInterface $em, \Swift_Mailer $mailer): Response
    {
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('no-reply@strollad.fr')
            ->setTo('mikaelkael.fr@gmail.com')
            ->setBody(
                $this->renderView(
                // templates/emails/registration.html.twig
                    'emails/generer_password.html.twig',
                    array('name' => $utilisateur->getNom())
                ),
                'text/html'
            );
        $mailer->send($message);
        return $this->redirectToRoute('utilisateur_voir', ['id' => $utilisateur->getId()]);
    }

    /**
     * @Route("/{id}/desactiver", name="utilisateur_desactiver", requirements = { "id" = "\d+" })
     */
    public function desactiver(Utilisateur $utilisateur, EntityManagerInterface $em): Response
    {
        $utilisateur->setUsername('');
        $utilisateur->setPassword('');
        $utilisateur->setRole('');
        $em->persist($utilisateur);
        $em->flush();
        return $this->redirectToRoute('utilisateur_voir', ['id' => $utilisateur->getId()]);
    }

}