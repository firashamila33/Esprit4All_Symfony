<?php
/**
 * Created by PhpStorm.
 * User: plazma33
 * Date: 11/10/2017
 * Time: 2:50 PM
 */

namespace FrontEndBundle\Controller;

use EspritForAll\BackEndBundle\Entity\Membre;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FrontEndBundle\Entity\Club;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use FrontEndBundle\Entity\Evenement;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use FrontEndBundle\Form\ClubForm;
use Symfony\Component\HttpFoundation\Tests\StringableObject;


class ClubController extends Controller
{
    public function indexAction()
    {
        return $this->render('FrontEndBundle:Club:ClubAccueil.html.twig');
    }

    public function ListClubAction()
    {
        $em = $this->getDoctrine()->getManager();
        $clubs = $em->getRepository("EspritForAllBackEndBundle:Club")->findAll();
        $events = $em->getRepository("EspritForAllBackEndBundle:Evenement")->findAll();
        $membre = $em->getRepository("EspritForAllBackEndBundle:Membre")->findAll();


        return $this->render('FrontEndBundle:Club:ListClub.html.twig', array("club" => $clubs, "events" => $events, "membres" => $membre));
    }

    function AjoutClubAction(Request $request)
    {
        $club = new Club();

        $form = $this->createFormBuilder($club)//creation d'un formulaire d'ajout club
        ->add('Libelle', textType::class, array("required" => true))
            ->add('Description', textType::class, array("required" => true))
            ->add('pathImg', textType::class, array("required" => true))
            ->add('pathCouverture', textType::class, array("required" => true))
            ->add('Apropos')
            ->add('notreHistoire')
            ->add('Ajouter', submitType::class)
            ->getForm();

        $form->handleRequest($request);//action sur le bouton
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($club);
            $em->flush();
            return $this->redirectToRoute('AfficheClubsF');
        }
        return $this->render('FrontEndBundle:Club:AjoutClub.html.twig', array('form' => $form->createView()));
    }

    public function DeleteClubAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $clubs = $em->getRepository("EspritForAllBackEndBundle:Club")->find($id);//esmbundle puis esm class "MODELE"
        $em->remove($clubs);
        $em->flush();
        return $this->redirectToRoute('AfficheClubsF');

    }

    public function UpdateClubAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $clubs = $em->getRepository("FrontEndBundle:Club")->find($id);
        $Form = $this->createForm(ClubForm::class, $clubs);
        $Form->handleRequest($request);
        if ($Form->isValid()) {

            $em->persist($clubs);
            $em->flush();
            return $this->redirectToRoute('AfficheClubFparId', array('id' => $id));

        }
        return $this->render('FrontEndBundle:Club:UpdateClub.html.twig', array('form' => $Form->createView()));//esm bundle puis repertoire puis esm view

    }

    public function ProfilClubAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $clubs = $em->getRepository("EspritForAllBackEndBundle:Club")->find($id);
        $events = $em->getRepository("EspritForAllBackEndBundle:Evenement")->findBy(array("club" => $clubs),array('date'=>'desc'));
        $membre = $em->getRepository("EspritForAllBackEndBundle:Membre")->findBy(array("club" => $clubs));
        return $this->render('FrontEndBundle:Club:ClubProfil.html.twig', array("club" => $clubs, "events" => $events, "membres" => $membre));//esm bundle puis repertoire puis esm view

    }


    //###################################################    Membre   ###################################################


    function AjoutMembreAction(Request $request, $id)
    {
        $membre = new Membre();

        $form = $this->createFormBuilder($membre)//creation d'un formulaire d'ajout club
        ->add('role', textType::class, array('label' => 'Role', 'attr' => array('placeholder' => "Role", "required" => true)))
            ->add('User', EntityType::class, array(
                'class' => 'EspritForAllBackEndBundle:User',
                'choice_label' => function ($user) {
                    return $user->getUserNP();
                }))
            ->add('Ajouter', submitType::class)
            ->getForm();
        $form->handleRequest($request);//action sur le bouton
        $em = $this->getDoctrine()->getManager();
        $clubs = $em->getRepository("EspritForAllBackEndBundle:Club")->find($id);
        if ($form->isValid()) {
            $em->persist($membre);
            $membre->setClub($clubs);
            $em->flush();
            return $this->redirectToRoute('AfficheClubFparId', array('id' => $id));
        }
        return $this->render('FrontEndBundle:Club:AjoutMembre.html.twig', array('form' => $form->createView(), "club" => $clubs));
    }


    public function DeleteMembreAction($id, $idc)
    {
        $em = $this->getDoctrine()->getManager();
        $membre = $em->getRepository("EspritForAllBackEndBundle:Membre")->find($id);//esmbundle puis esm class "MODELE"
        $clubs = $em->getRepository("EspritForAllBackEndBundle:Club")->find($id);
        $em->remove($membre);
        $em->flush();
        return $this->redirectToRoute("AfficheClubFparId", array('id' => $idc, 'club' => $clubs));
    }
}