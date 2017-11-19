<?php
/**
 * Created by PhpStorm.
 * User: plazma33
 * Date: 11/10/2017
 * Time: 2:48 PM
 */

namespace FrontEndBundle\Controller;
use EspritForAll\BackEndBundle\Entity\Covoiturage;
use EspritForAll\BackEndBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;


class CovoiturageController extends Controller
{

    public function indexAction()
    {
        return $this->render('FrontEndBundle:Covoiturage:CovoiturageAccueil.html.twig');
    }

    public function chercherAction(Request $request)
    {
        $covoiturage=new Covoiturage();
        $em=$this->getDoctrine()->getManager();
        if($request->get('depart')!="" and $request->get('arrive')!=""){
            $covoiturage->setDepart($request->get('depart'));
            $covoiturage->setArrive($request->get('arrive'));
            $covoiturage=$em->getRepository("EspritForAllBackEndBundle:Covoiturage")->findBy(array('depart'=>$covoiturage->getDepart(),'arrive'=>$covoiturage->getArrive()));
        }
        else if($request->get('depart')!="" and $request->get('arrive')==""){
            $covoiturage->setDepart($request->get('depart'));
            $covoiturage->setArrive($request->get('arrive'));
            $covoiturage=$em->getRepository("EspritForAllBackEndBundle:Covoiturage")->findBy(array('depart'=>$covoiturage->getDepart()));
        }else if($request->get('depart')=="" and $request->get('arrive')!=""){
        $covoiturage->setDepart($request->get('depart'));
        $covoiturage->setArrive($request->get('arrive'));
        $covoiturage=$em->getRepository("EspritForAllBackEndBundle:Covoiturage")->findBy(array('arrive'=>$covoiturage->getArrive()));
        }else{
            $covoiturage=$em->getRepository("EspritForAllBackEndBundle:Covoiturage")->findAll();
        }
       return $this->render('FrontEndBundle:Covoiturage:chercher.html.twig',array('covoiturages'=>$covoiturage));
    }

    public function versAction()
    {
        return $this->render('FrontEndBundle:Covoiturage:ajout.html.twig');
    }

    public function versmAction()
    {
        $covoiturage=new Covoiturage();
        $user=new User();
        $em=$this->getDoctrine()->getManager();
        $user=$em->getRepository("EspritForAllBackEndBundle:User")->find(12);
        $covoiturage=$em->getRepository("EspritForAllBackEndBundle:Covoiturage")->findByUser($user);
        return $this->render('FrontEndBundle:Covoiturage:modifier.html.twig',array('covoiturages'=>$covoiturage));
    }

    public function ajoutAction(Request $request){
        $covoiturage=new Covoiturage();
        $user=new User();
        $em=$this->getDoctrine()->getManager();
        $user=$em->getRepository("EspritForAllBackEndBundle:User")->find(12);
        if($request->isMethod('post')){
            $covoiturage->setUser($user);
            $covoiturage->setPrix($request->get('prix'));
            $covoiturage->setDepart($request->get('depart'));
            $covoiturage->setArrive($request->get('arrive'));
            $covoiturage->setDescription($request->get('description'));
            $covoiturage->setNbreplace($request->get('nbreplace'));
            $covoiturage->setHeureDepart(null);
            $covoiturage->setVoiture($request->get('voiture'));
            $em->persist($covoiturage);
            $em->flush();
        }
        return $this->render('FrontEndBundle:Covoiturage:ajout.html.twig',array());
    }

    public function listerAction(){
        $covoiturage=new Covoiturage();
        $user=new User();
        $em=$this->getDoctrine()->getManager();
        $user=$em->getRepository("EspritForAllBackEndBundle:User")->find(12);
        $covoiturage=$em->getRepository("EspritForAllBackEndBundle:Covoiturage")->findOneBy(array('user'=>$user->getId()));
    }

    public function deleteAction($id){
        $em=$this->getDoctrine()->getManager();
        $covoiturage=$em->getRepository("EspritForAllBackEndBundle:Covoiturage")->find($id);
        $em->remove($covoiturage);
        $em->flush();
        return $this->redirectToRoute('front_end_versModifiercovoiturage');
    }
}