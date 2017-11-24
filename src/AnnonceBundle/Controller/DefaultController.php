<?php

namespace AnnonceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        $res = $em->getRepository('\AnnonceBundle\Entity\AnnonceObjetPerdu')->findAll();


        return new Response(var_dump($res));



        //return $this->render('AnnonceBundle:Default:index.html.twig');
    }

}
