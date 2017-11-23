<?php
namespace EspritForAll\BackEndBundle\Controller;

use EspritForAll\BackEndBundle\Entity\Evenement;
use EspritForAll\BackEndBundle\Entity\Club;

use EspritForAll\BackEndBundle\Form\EvenementForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;



class EvenementController extends Controller
{
    /**
     * @Route("/")
     */
    public function ListEvenementAction()
    {
        $em= $this->getDoctrine()->getManager();
        $evenements=$em->getRepository("EspritForAllBackEndBundle:Evenement")->findBy(array(),array('id'=>'desc'));
        return $this->render('EspritForAllBackEndBundle:Evenement:ListEvenement.html.twig',array("evenement"=>$evenements));
    }

    function AjoutEvenementAction(Request $request)
    {
        $event = new Evenement();

        $form = $this->createFormBuilder($event)//creation d'un formulaire d'ajout club

        ->add('libelle')
            ->add('type')
            ->add('pathImg')
            ->add('date')
            ->add('Club',EntityType::class,array('class'=>'EspritForAllBackEndBundle:Club','multiple'=>false,'choice_label'=>'Libelle'))
            ->add('description')
            ->add('Ajouter', submitType::class)
            ->getForm();

        $form->handleRequest($request);//action sur le bouton
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();
            return $this->redirectToRoute('AfficheEvenement');
        }
        return $this->render('EspritForAllBackEndBundle:Evenement:AjoutEvent.html.twig', array('form' => $form->createView()));
    }

    public function UpdateEvenementAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $events = $em->getRepository("EspritForAllBackEndBundle:Evenement")->find($id);
        $Form = $this->createForm(EvenementForm::class, $events);

        $Form->handleRequest($request);
        if ($Form->isValid()) {

            $em->persist($events);
            $em->flush();
            return $this->redirectToRoute('AfficheEvenement');

        }
        return $this->render('EspritForAllBackEndBundle:Evenement:UpdateEvenement.html.twig', array('form' => $Form->createView()));//esm bundle puis repertoire puis esm view


    }

    public function DeleteEvenementAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $events = $em->getRepository("EspritForAllBackEndBundle:Evenement")->find($id);//esmbundle puis esm class "MODELE"
        $em->remove($events);
        $em->flush();
        return $this->redirectToRoute('AfficheEvenement');

    }
}
