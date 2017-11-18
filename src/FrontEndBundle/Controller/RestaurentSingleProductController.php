<?php
/**
 * Created by PhpStorm.
 * User: plazma33
 * Date: 11/15/2017
 * Time: 1:02 AM
 */

namespace FrontEndBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class RestaurentSingleProductController extends Controller
{
    public function indexAction()
    {
        return $this->render('FrontEndBundle:Restaurent:SingleProduct.html.twig');
    }

    public function GetMealAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $menu = $em->getRepository("EspritForAllBackEndBundle:Menu")->findOneBy(array('id' => $id));

        return $this->render('FrontEndBundle:Restaurent:SingleProduct.html.twig', array('menu' => $menu));
    }
}