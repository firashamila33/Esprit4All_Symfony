<?php
/**
 * Created by PhpStorm.
 * User: plazma33
 * Date: 11/10/2017
 * Time: 2:48 PM
 */

namespace FrontEndBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class CovoiturageController extends Controller
{

    public function indexAction()
    {
        return $this->render('FrontEndBundle:Covoiturage:CovoiturageAccueil.html.twig');
    }

}