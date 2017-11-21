<?php
/**
 * Created by PhpStorm.
 * User: plazma33
 * Date: 11/10/2017
 * Time: 2:49 PM
 */

namespace FrontEndBundle\Controller;
use EspritForAll\BackEndBundle\Entity\UtilisateurHasRevision;
use Monolog\Handler\UdpSocketTest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use mikehaertl\wkhtmlto\Pdf;


use EspritForAll\BackEndBundle\Entity\Revision;
use EspritForAll\BackEndBundle\Entity\User;






class RevisionController extends Controller
{
    public function indexAction()
    {
        return $this->render('FrontEndBundle:Revision:RevisionAccueil.html.twig');
    }

    public function ListRevAction()
    {
        $em = $this->getDoctrine()->getManager();
        $revision = $em->getRepository("EspritForAllBackEndBundle:Revision")->findAll();
        return $this->render('FrontEndBundle:Revision:RevisionAccueil.html.twig', array("Revision" => $revision));

    }
    public function AjoutAction( Request $request)
    { $revision = new Revision();
        if ($request->isMethod('POST')) {
            $time = new \DateTime($request->get('datedebut'));
            $time->format('Y-m-d');
            $time2 = new \DateTime($request->get('datedebut'));
            $time2->format('Y-m-d');
            $revision->setMatiere($request->get('matiere'));
            $revision->setDateDebut($time);
            $revision->setDateFin($time2);
            $revision->setDescription($request->get('description'));
            $revision->setNbremax($request->get('nbremax'));
            $revision->setType($request->get('type'));
            $u = new User();
            $revision->setUser($u->getId());

            $em = $this->getDoctrine()->getManager();
            $em->persist($revision);
            $em->flush();
            return $this->redirectToRoute('AficheRevision');
        }
        return $this->render('FrontEndBundle:Revision:FormRevision.html.twig');
    }
    public function DeleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $revision = $em->getRepository("EspritForAllBackEndBundle:Revision")->find($id);//esmbundle puis esm class "MODELE"
        $em->remove($revision);
        $em->flush();
        return $this->redirectToRoute('AficheRevision');


    }
    public function redirectionAction(  Request $request, $id)

    {

        $hasrev = new UtilisateurHasRevision();
        $em = $this->getDoctrine()->getManager();
        $revision = $em->getRepository("EspritForAllBackEndBundle:Revision")->find($id);
        $r= $revision->getNbremax();
        if($r==0)
            return $this->redirectToRoute('AficheRevision');
        else
        {
            $r= $revision->getNbremax()-1;
            $revision->setNbremax($r);
            $em = $this->getDoctrine()->getManager();
            $hasrev->setId($request->get('idrev'));
            $hasrev->setUser($request->get('iduser'));

            $em->persist($hasrev);
            $em->flush( );
            $em->persist($revision);
            $em->flush( );}

            return $this->render('FrontEndBundle:Revision:GrpRev.html.twig', array("Revision" => $revision));












    }
    public function UpdateAction( Request $request,$id)
    { $revision=new Revision();
        $em= $this->getDoctrine()->getManager();
        $revision=$em->getRepository("EspritForAllBackEndBundle:Revision")->find($id);


        if ($request->isMethod('POST')){

            $time = new \DateTime($request->get('datedebut'));
            $time->format('Y-m-d');
            $time2 = new \DateTime($request->get('datedebut'));
            $time2->format('Y-m-d');
            $revision->setMatiere($request->get('matiere'));
            $revision->setDateDebut($time);
            $revision->setDateFin($time2);
            $revision->setDescription($request->get('description'));
            $revision->setNbremax($request->get('nbremax'));
            $revision->setType($request->get('type'));
            $u = new User();
            $revision->setUser($u->getId());
            $em = $this->getDoctrine()->getManager();

            $em->persist($revision);
            $em->flush( );
            return $this->redirectToRoute('AficheRevision');

        }
        return $this->render('FrontEndBundle:Revision:UpdateRev.html.twig', array("Revision" => $revision));

    }

    function searchAction(Request $request)
    {


        $revision = new Revision();
        $em = $this->getDoctrine()->getManager();
        if ($request->isMethod('POST')) {
            $revision->setMatiere($request->get('matiere'));

            $revision = $em->getRepository("EspritForAllBackEndBundle:Revision")->findBy(array('matiere' => $revision->getMatiere()));
        } else {
            $revision = $em->getRepository("EspritForAllBackEndBundle:Revision")->findAll();
        }
        return $this->render('FrontEndBundle:Revision:RevisionAccueil.html.twig', array("Revision" => $revision));
    }}

