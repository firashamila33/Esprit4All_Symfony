<?php
/**
 * Created by PhpStorm.
 * User: plazma33
 * Date: 11/15/2017
 * Time: 2:48 AM
 */

namespace FrontEndBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class RestaurentMenuController extends Controller
{
    public function cotegoriesAction()
    {
        return $this->render('FrontEndBundle:Restaurent:MenuCategories.html.twig');
    }

    public function sub_categoriesAction()
    {
        return $this->render('FrontEndBundle:Restaurent:MenuSubCategories.html.twig');
    }


}