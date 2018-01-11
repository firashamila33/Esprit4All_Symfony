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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
//use FrontEndBundle\Modele\Document;

class ProfilController extends Controller
{
    public function indexAction()
    {
        $user=new User();
        $profil=new Profil();
        $club=new Club();
        $evenement=new Evenement();
        $em=$this->getDoctrine()->getManager();
        $haja= $this->getUser()->getId();
        $user=$em->getRepository("EspritForAllBackEndBundle:User")->find($haja);
        $profil=$em->getRepository("EspritForAllBackEndBundle:Profil")->findOneByUser($user);
        $club=$em->getRepository("EspritForAllBackEndBundle:Club")->findByUser($user);
        $evenement=$em->getRepository("EspritForAllBackEndBundle:Evenement")->findByClub($club);
        if($profil==null){
            return $this->render('FrontEndBundle:Profil:edit.html.twig',array('user'=>$user,'profil'=>new Profil()));
        }else {
            return $this->render('FrontEndBundle:Profil:profil.html.twig', array('user' => $user, 'profil' => $profil, 'clubs' => $club, 'evenements' => $evenement));
        }
    }

    public function editerAction(){
        $em=$this->getDoctrine()->getManager();
        $haja= $this->getUser()->getId();
        $user=$em->getRepository("EspritForAllBackEndBundle:User")->find($haja);
        $profil=$em->getRepository("EspritForAllBackEndBundle:Profil")->findOneByUser($user);
        return $this->render('FrontEndBundle:Profil:edit.html.twig',array('user'=>$user,'profil'=>$profil));
    }

    public function modifierAction(Request $request){
        $haja= $this->getUser()->getId();
        $em=$this->getDoctrine()->getManager();
        $user=$em->getRepository("EspritForAllBackEndBundle:User")->find($haja);
        $profil=$em->getRepository("EspritForAllBackEndBundle:Profil")->findOneBy(array('user'=>$user->getId()));
        $user->setNom($request->get('nom'));
        $user->setPrenom($request->get('prenom'));
        $user->setEmail($request->get('email'));
        $user->setAdress($request->get('adress'));
        $em->persist($user);
        $em->flush();
        if($profil==null){
            $profil= new Profil();
        }
        $profil->setAge($request->get('age'));
        $profil->setUser($user);
        $profil->setClasse($request->get('classe'));
        $profil->setDescription($request->get('description'));
        $profil->setTel($request->get('tel'));
        $profil->setLinkG($request->get('linkG'));
        $profil->setLinkFb($request->get('linkFb'));
        $profil->setLinkLd($request->get('linkLd'));
        if($request->get('pathImg')!=""){
            $profil->setPathImg('img/cov/'.$request->get('pathImg'));
        }
        if($request->get('pathCv')!=""){
            //$file = $request->get('pathCv');
            //$this->cast(UploadedFile::class,$file);
            //$fileName = md5(uniqid()).'.'.substr($file,-3);
            //$file->move(
               // $this->getParameter('brochures_directory'),
               // $fileName
           // );
            $profil->setPathCv($request->get('pathCv'));
        }
        $em->persist($profil);
        $em->flush();
        return $this->render('FrontEndBundle:Profil:profil.html.twig',array('user'=>$user,'profil'=>$profil,'clubs'=> new Club(),'evenements'=> new Evenement()));
    }

//    function cast($destination, $sourceObject)
//    {
//        if (is_string($destination)) {
//            $destination = new $destination();
//        }
//        $sourceReflection = new \ReflectionObject($sourceObject);
//        $destinationReflection = new \ReflectionObject($destination);
//        $sourceProperties = $sourceReflection->getProperties();
//        foreach ($sourceProperties as $sourceProperty) {
//            $sourceProperty->setAccessible(true);
//            $name = $sourceProperty->getName();
//            $value = $sourceProperty->getValue($sourceObject);
//            if ($destinationReflection->hasProperty($name)) {
//                $propDest = $destinationReflection->getProperty($name);
//                $propDest->setAccessible(true);
//                $propDest->setValue($destination,$value);
//            } else {
//                $destination->$name = $value;
//            }
//        }
//        return $destination;
//    }
}