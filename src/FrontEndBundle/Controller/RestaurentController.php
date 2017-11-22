<?php
/**
 * Created by PhpStorm.
 * User: plazma33
 * Date: 11/9/2017
 * Time: 5:59 PM
 */
namespace FrontEndBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RestaurentController extends Controller
{
    public function indexAction()
    {
        return $this->render('FrontEndBundle:Restaurent:RestaurentAccueil.html.twig');
    }
}