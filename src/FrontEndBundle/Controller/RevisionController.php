<?php
/**
 * Created by PhpStorm.
 * User: plazma33
 * Date: 11/10/2017
 * Time: 2:49 PM
 */

namespace FrontEndBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class RevisionController extends Controller
{
    public function indexAction()
    {
        return $this->render('FrontEndBundle:Revision:RevisionAccueil.html.twig');
    }
}