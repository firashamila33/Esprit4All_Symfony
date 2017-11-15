<?php

namespace EspritForAll\BackEndBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


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
