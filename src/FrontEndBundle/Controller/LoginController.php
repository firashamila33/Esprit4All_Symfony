<?php
/**
 * Created by PhpStorm.
 * User: plazma33
 * Date: 11/10/2017
 * Time: 1:26 PM
 */

namespace FrontEndBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class LoginController extends Controller
{
    public function indexAction()
    {
        return $this->render('FrontEndBundle:Login:Loginn.html.twig');

    }
}