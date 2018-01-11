<?php
/**
 * Created by PhpStorm.
 * User: yacine farhat
 * Date: 23/11/2017
 * Time: 19:19
 */

namespace EspritForAll\BackEndBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CovoiturageController extends Controller
{
    public function listAction(){
        $em=$this->getDoctrine()->getManager();
        $covoiturage=$em->getRepository("EspritForAllBackEndBundle:Covoiturage")->findAll();
        return $this->render('EspritForAllBackEndBundle:Covoiturage:list.html.twig',array('covoiturages'=>$covoiturage));
    }

    public function deleteAction($id){
        $em=$this->getDoctrine()->getManager();
        $covoiturage=$em->getRepository("EspritForAllBackEndBundle:Covoiturage")->find($id);
        $em->remove($covoiturage);
        $em->flush();
        return $this->redirectToRoute('ListCovoiturage');
    }
}