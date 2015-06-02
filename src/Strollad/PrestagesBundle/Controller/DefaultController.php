<?php

namespace Strollad\PrestagesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('StrolladPrestagesBundle:Default:index.html.twig');
    }
}
