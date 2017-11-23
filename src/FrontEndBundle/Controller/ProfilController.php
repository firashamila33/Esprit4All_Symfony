<?php
/**
 * Created by PhpStorm.
 * User: yacine farhat
 * Date: 22/11/2017
 * Time: 01:52
 */

namespace FrontEndBundle\Controller;


use EspritForAll\BackEndBundle\Entity\Club;
use EspritForAll\BackEndBundle\Entity\Evenement;
use EspritForAll\BackEndBundle\Entity\Profil;
use EspritForAll\BackEndBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProfilController extends Controller
{
    public function indexAction()
    {
        $user=new User();
        $profil=new Profil();
        $club=new Club();
        $evenement=new Evenement();
        $em=$this->getDoctrine()->getManager();
        $user=$em->getRepository("EspritForAllBackEndBundle:User")->find(1);
        $profil=$em->getRepository("EspritForAllBackEndBundle:Profil")->findOneByUser($user);
        $club=$em->getRepository("EspritForAllBackEndBundle:Club")->findByUser($user);
        $evenement=$em->getRepository("EspritForAllBackEndBundle:Evenement")->findByClub($club);
        return $this->render('FrontEndBundle:Profil:profil.html.twig',array('user'=>$user,'profil'=>$profil,'clubs'=>$club,'evenements'=>$evenement));
    }
}