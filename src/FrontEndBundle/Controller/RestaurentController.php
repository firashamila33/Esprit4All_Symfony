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

        //GETTING ALL THE MENU ITEMS TO BE RENDERED TO LAYOUT AND CONVERTED TO JSON
        $em = $this->getDoctrine()->getManager();
        $menu = $em->getRepository("EspritForAllBackEndBundle:Menu")->findAll();

        return $this->render('FrontEndBundle:Restaurent:RestaurentAccueil.html.twig',array('menu' => $menu));
    }



}