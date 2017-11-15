<?php
/**
 * Created by PhpStorm.
 * User: majdi
 * Date: 09/11/2017
 * Time: 21:55
 */

namespace EspritForAll\BackEndBundle\Controller;

use EspritForAll\BackEndBundle\Form\ClubForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use EspritForAll\BackEndBundle\Entity\Club;
use Symfony\Component\HttpFoundation\Request;

class ClubController extends Controller
{
    /**
     * @Route("/")
     */
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
            return $this->redirectToRoute('AfficheClubs');
        }
        return $this->render('EspritForAllBackEndBundle:Club:AjoutClub.html.twig', array('form' => $form->createView()));
    }

    public function ListClubAction()
    {
        $em = $this->getDoctrine()->getManager();
        $clubs = $em->getRepository("EspritForAllBackEndBundle:Club")->findAll();

        return $this->render('EspritForAllBackEndBundle:Club:ListClub.html.twig', array("club" => $clubs));
    }

    public function AjoutAction()
    {
        return $this->render('EspritForAllBackEndBundle::BackEndAcceuil.html.twig');
    }


    public function UpdateClubAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $clubs = $em->getRepository("EspritForAllBackEndBundle:Club")->find($id);
        $Form = $this->createForm(ClubForm::class, $clubs);

        $Form->handleRequest($request);
        if ($Form->isValid()) {

            $em->persist($clubs);
            $em->flush();
            return $this->redirectToRoute('AfficheClubs');

        }
        return $this->render('EspritForAllBackEndBundle:Club:UpdateClub.html.twig', array('form' => $Form->createView()));//esm bundle puis repertoire puis esm view

    }

    public function DeleteClubAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $clubs = $em->getRepository("EspritForAllBackEndBundle:Club")->find($id);//esmbundle puis esm class "MODELE"
        $em->remove($clubs);
        $em->flush();
        return $this->redirectToRoute('AfficheClubs');

    }
}