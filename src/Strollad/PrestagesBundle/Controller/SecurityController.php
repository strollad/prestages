<?php

namespace Strollad\PrestagesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class SecurityController extends Controller
{

    /**
     * @Route("/login", name="strollad_prestages_login")
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        return $this->render(
            'StrolladPrestagesBundle:Security:login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $authenticationUtils->getLastUsername(),
                'error'         => $authenticationUtils->getLastAuthenticationError()
            )
        );
    }

    /**
     * @Route("/login_check", name="strollad_prestages_login_check")
     */
    public function loginCheckAction()
    {
        // this controller will not be executed,
        // as the route is handled by the Security system
    }

    /**
     * @Route("/logout", name="strollad_prestages_logout")
     */
    public function logoutAction()
    {
        // this controller will not be executed,
        // as the route is handled by the Security system
    }

    /**
     * @Route("/change-my-password", name="strollad_prestages_change_my_password")
     */
    public function changeMyPasswordAction(Request $request)
    {
        $pass1 = $request->request->get('new-pass-1');
        $pass2 = $request->request->get('new-pass-2');
        if ($pass1 == $pass2) {
            if (strlen($pass1) >= 8) {
                $me       = $this->get('security.token_storage')->getToken()->getUser();
                $encoder  = $this->container->get('security.password_encoder');
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
        return $this->redirectToRoute('strollad_prestages_myprofil');
    }
}