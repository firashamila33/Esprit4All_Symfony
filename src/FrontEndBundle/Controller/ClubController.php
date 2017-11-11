<?php
/**
 * Created by PhpStorm.
 * User: plazma33
 * Date: 11/10/2017
 * Time: 2:50 PM
 */

namespace FrontEndBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ClubController extends Controller
{
    public function indexAction()
    {
        return $this->render('FrontEndBundle:Club:ClubAccueil.html.twig');
    }
}