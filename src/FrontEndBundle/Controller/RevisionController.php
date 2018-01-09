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
use Ob\HighchartsBundle\Highcharts\Highchart;



use EspritForAll\BackEndBundle\Entity\Revision;
use EspritForAll\BackEndBundle\Entity\User;

use Symfony\Component\HttpFoundation\Response;


class RevisionController extends Controller
{
    public function indexAction()
    {
        return $this->render('FrontEndBundle:Revision:RevisionAccueil.html.twig');
    }

    public function ListRevAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
          $paginator= $this->get('knp_paginator');
        $revision = $em->getRepository("EspritForAllBackEndBundle:Revision")->findAll();
        $result=  $paginator->paginate(
            $revision,
         $request->query->getInt( 'page',1),
         $request->query->getInt('limit',3)

    );
        $u= $em->getRepository("EspritForAllBackEndBundle:User")->findAll();

        $series = array(
            array("name" => "Data Serie Name",    "data" => array(1,2,4,5,6,3,8))
        );







        return $this->render('FrontEndBundle:Revision:RevisionAccueil.html.twig', array("Revision" => $result,"User"=> $u));

    }


    public function AjoutAction( Request $request)
    { $revision = new Revision();
        if ($request->isMethod('POST')) {
            $time = new \DateTime($request->get('datedebut'));
            $time->format('Y-m-d');
            $time2 = new \DateTime($request->get('datefin'));
            $time2->format('Y-m-d');
            $revision->setMatiere($request->get('matiere'));
            $revision->setDateDebut($time);
            $revision->setDateFin($time2);
            $revision->setDescription($request->get('description'));
            $revision->setNbremax($request->get('nbremax'));
            $revision->setType($request->get('type'));
            $id = $this->getUser()->getId();
            $em = $this->getDoctrine()->getManager();

            $u = $em->getRepository("EspritForAllBackEndBundle:User")->find($id);

            $revision->setUser($u );

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
        $idd = $this->getUser()->getId();
        $rr = $em->getRepository("EspritForAllBackEndBundle:Revision")->find($id);
        $uu = $em->getRepository("EspritForAllBackEndBundle:User")->find($idd);



        if ($rr->getUser() != $uu)
        {            return $this->redirectToRoute('AficheRevision');}
        else {
        $ur = $em->getRepository("EspritForAllBackEndBundle:UtilisateurHasRevision")->findOneBy(array('revision' => $id));
        if($ur!=null)
        {$em->remove($ur);
        $em->flush();

        $revision = $em->getRepository("EspritForAllBackEndBundle:Revision")->find($id);//esmbundle puis esm class "MODELE"
        $em->remove($revision);
        $em->flush();}
        else
        { $revision = $em->getRepository("EspritForAllBackEndBundle:Revision")->find($id);//esmbundle puis esm class "MODELE"
            $em->remove($revision);
            $em->flush();}
        return $this->redirectToRoute('AficheRevision');
    }}
    public function redirectionAction($id)

    {

        $hasrev = new UtilisateurHasRevision();
        $em = $this->getDoctrine()->getManager();
        $revision = $em->getRepository("EspritForAllBackEndBundle:Revision")->find($id);
        $r= $revision->getNbremax();
        $idd = $this->getUser()->getId();
        $ur = $em->getRepository("EspritForAllBackEndBundle:UtilisateurHasRevision")->findOneBy(array('user' => $idd));
        if($r==0)
            return $this->redirectToRoute('AficheRevision');
        else if ($ur!=null)
        {            return $this->redirectToRoute('AficheRevision');}
        else {

            $r = $revision->getNbremax() - 1;
            $revision->setNbremax($r);
            $em = $this->getDoctrine()->getManager();

            $u = $em->getRepository("EspritForAllBackEndBundle:User")->find($this->getUser()->getId());
            $hasrev->setRevision($revision);
            $hasrev->setUser($u);
            $em->persist($hasrev);
            $em->flush();
            return $this->render('FrontEndBundle:Revision:GrpRev.html.twig', array("Revision" => $revision, "User" => $u));

        }
        }


    public function redirection2Action()

    {

        $em = $this->getDoctrine()->getManager();
        $idd = $this->getUser()->getId();
        $ur = $em->getRepository("EspritForAllBackEndBundle:UtilisateurHasRevision")->findOneBy(array('user' => $idd));

        if ($ur==null)
        {            return $this->redirectToRoute('AficheRevision');}
        else {
            $revision = $em->getRepository("EspritForAllBackEndBundle:Revision")->findOneBy(array('id' => $ur->getRevision()));
            $ur = $em->getRepository("EspritForAllBackEndBundle:User")->findOneBy(array('id' => $ur->getUser()));

            return $this->render('FrontEndBundle:Revision:GrpRev.html.twig', array("Revision" => $revision, "User" => $ur));
        }}

            public function UpdateAction(Request $request, $id)
            {
                $revision = new Revision();
                $em = $this->getDoctrine()->getManager();
                $revision = $em->getRepository("EspritForAllBackEndBundle:Revision")->find($id);


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
                return $this->render('FrontEndBundle:Revision:UpdateRev.html.twig', array("Revision" => $revision));

            }

            function searchAction(Request $request)
            {
$u = new User();

                $revision = new Revision();
                $em = $this->getDoctrine()->getManager();
                $paginator= $this->get('knp_paginator');
                if ($request->isMethod('POST')) {
                    if((  $request->get('matiere')!= "") and ($request->get('sel')==""))
                    {

                    $revision->setMatiere($request->get('matiere'));




                    $revision = $em->getRepository("EspritForAllBackEndBundle:Revision")->findBy(array('matiere' => $revision->getMatiere()));

                    $result=  $paginator->paginate(
                        $revision,
                        $request->query->getInt( 'page',1),
                        $request->query->getInt('limit',3)

                    );
                        return $this->render('FrontEndBundle:Revision:RevisionAccueil.html.twig', array("Revision" => $result,"User"=> $u));
                    }
                 else if( (  $request->get('matiere')== "") and ($request->get('sel')!=""))
                    {$u->setNom($request->get('sel'));




                        $ur = $em->getRepository("EspritForAllBackEndBundle:User")->findBy(array('nom' => $u->getNom()));
                        $revision = $em->getRepository("EspritForAllBackEndBundle:Revision")->findBy(array('user' => $ur));


                        $result=  $paginator->paginate(
                            $revision,
                            $request->query->getInt( 'page',1),
                            $request->query->getInt('limit',3)

                        );
                        return $this->render('FrontEndBundle:Revision:RevisionAccueil.html.twig', array("Revision" => $result,"User"=> $u));

                    }


                } else {
                    $revision = $em->getRepository("EspritForAllBackEndBundle:Revision")->findAll();

                    $result=  $paginator->paginate(
                        $revision,
                        $request->query->getInt( 'page',1),
                        $request->query->getInt('limit',3) );
                return $this->render('FrontEndBundle:Revision:RevisionAccueil.html.twig', array("Revision" => $result,"User"=> $u));


                }
                return $this->redirectToRoute('rechercherev');}

            public function PdfAction()
            {
                $snappy=$this->get("knp_snappy.pdf");
                $filename = "Pdf_Cour_java";
                $websiteur = "https://openclassrooms.com/courses/apprenez-a-programmer-en-java";
                return new Response(
                    $snappy->getOutput($websiteur),
                    //status code ok
                200,
                    array(
                        'content-type'=>'application/pdf',
                    'content-Disposition' => 'inline; filname="'.$filename.'.pdf"'
                    )
            );
            }
            public  function  pdf2Action()
            {                $snappy=$this->get("knp_snappy.pdf");
            $html= $this->renderView("FrontEndBundle:Revision:pdf.html.twig",array("title " =>"awesome PDF Title"));
            $filename="cour_web";
                return new Response(
                    $snappy->getOutputFromHtml($html),
                    //status code ok
                    200,
                    array(
                        'content-type'=>'application/pdf',
                        'content-Disposition' => 'inline; filname="'.$filename.'.pdf"'
                    ));



            }
    public function SendMail2Action(Request $request)
    {  if ($request->isMethod('POST')){
        $sub=$request->get('subject');
        $text=$request->get('text');
        $mail=$request->get('mail');
        $message = \Swift_Message::newInstance()
            ->setSubject($sub)
            ->setFrom('espritforall@gmail.com')
            ->setTo($mail)
            ->setContentType('text/html')
            ->setBody($text)
        ;
        $this->get('mailer')->send($message);
        return $this->redirectToRoute('AfficheDocs');}
        else {        return $this->redirectToRoute('AfficheDocs');}
    }



        }