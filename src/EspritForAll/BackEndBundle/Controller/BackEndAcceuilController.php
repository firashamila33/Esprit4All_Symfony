<?php

namespace EspritForAll\BackEndBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BackEndAcceuilController extends Controller
{
    /**
     * @Route("/")
     */
    public function BackAction()
    {
        return $this->render('EspritForAllBackEndBundle::BackEndAcceuil.html.twig');
    }
}
