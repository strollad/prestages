<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class SecurityController extends Controller
{

    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request, AuthenticationUtils $authUtils)
    {
        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();
        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
        // this controller will not be executed,
        // as the route is handled by the Security system
    }

    /**
     * @Route("/changer-mot-passe", name="changer_mot_passe")
     */
    public function changerMotPasse(Request $request, TokenStorageInterface $token, UserPasswordEncoderInterface $encoder)
    {
        $pass1 = $request->request->get('new-pass-1');
        $pass2 = $request->request->get('new-pass-2');
        if ($pass1 == $pass2) {
            if (strlen($pass1) >= 8) {
                $me       = $token->getToken()->getUser();
                $password = $encoder->encodePassword($me, $pass1);
                $me->setPassword($password);
                $em = $this->getDoctrine()->getManager();
                $em->persist($me);
                $em->flush();
                $this->addFlash(
                    'success',
                    'Mot de passe changé'
                );
            } else {
                $this->addFlash(
                    'error',
                    'Vous devez fournir un mot de passe d\'au moins 8 caractères'
                );
            }
        } else {
            $this->addFlash(
                'error',
                'Les mots de passe fournis ne sont pas identiques'
            );
        }
        return $this->redirectToRoute('mon_profil');
    }
}