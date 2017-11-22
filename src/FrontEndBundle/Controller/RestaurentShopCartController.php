<?php
/**
 * Created by PhpStorm.
 * User: plazma33
 * Date: 11/15/2017
 * Time: 2:18 AM
 */

namespace FrontEndBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class RestaurentShopCartController extends Controller
{
    public function indexAction()
    {
        return $this->render('FrontEndBundle:Restaurent:ShopCart.html.twig');
    }
}