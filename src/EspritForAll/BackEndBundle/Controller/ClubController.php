<?php
/**
 * Created by PhpStorm.
 * User: majdi
 * Date: 09/11/2017
 * Time: 21:55
 */

namespace EspritForAll\BackEndBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use EspritForAll\BackEndBundle\Entity\Club;
class ClubController extends Controller
{/**
 * @Route("/")
 */

    public function ListClubAction()
    {
        $em= $this->getDoctrine()->getManager();
        $clubs=$em->getRepository("EspritForAllBackEndBundle:Club")->findAll();

        return $this->render('EspritForAllBackEndBundle:Club:ListClub.html.twig',array("club"=>$clubs));
    }
    public function AjoutAction()
    {
        return $this->render('EspritForAllBackEndBundle::BackEndAcceuil.html.twig');
    }

}