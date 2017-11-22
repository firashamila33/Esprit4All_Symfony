<?php
namespace FrontEndBundle\Controller;

use FrontEndBundle\Entity\Evenement;
use EspritForAll\BackEndBundle\Entity\Club;

use EspritForAll\BackEndBundle\Form\EvenementForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
        $evenements=$em->getRepository("FrontEndBundle:Evenement")->findBy(array(),array('id'=>'desc'));





        return $this->render('FrontEndBundle:Evenement:ListEvenement.html.twig',array("evenement"=>$evenements));
    }
    public function DeleteEvenementLAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $events = $em->getRepository("FrontEndBundle:Evenement")->find($id);//esmbundle puis esm class "MODELE"
        $em->remove($events);
        $em->flush();
        return $this->redirectToRoute('AfficheEvenementF');

    }
    public function DeleteEvenementCAction($id,$idc)
    {
        $em = $this->getDoctrine()->getManager();
        $events = $em->getRepository("EspritForAllBackEndBundle:Evenement")->find($id);//esmbundle puis esm class "MODELE"
        $em->remove($events);
        $em->flush();
        return $this->redirectToRoute("AfficheClubFparId",array('id'=>$idc));
    }

    function AjoutEvenementAction(Request $request, $id)
    {
        $events = new Evenement();

        $form = $this->createFormBuilder($events)//creation d'un formulaire d'ajout club
        ->add('Libelle', TextType::class, array('label' => 'Libelle', 'attr' => array('placeholder' => "Libelle", "required" => true)))

            ->add('type',TextType::class, array('label' => 'Type', 'attr' => array('placeholder' => "Type", "required" => true)))
            ->add('pathImg',TextType::class, array('label' => 'Couverture', 'attr' => array('placeholder' => "Image", "required" => true)))
            ->add('date',DateType::class,array('widget'=>'single_text'))
            ->add('description',TextType::class, array('label' => 'Description', 'attr' => array('placeholder' => "Description", "required" => true)))

            ->add('Ajouter', submitType::class)
            ->getForm();
        $form->handleRequest($request);//action sur le bouton
        $em = $this->getDoctrine()->getManager();
        $clubs = $em->getRepository("EspritForAllBackEndBundle:Club")->find($id);
        if ($form->isValid()) {
            $em->persist($events);
            $events->setClub($clubs);
            $em->flush();
            return $this->redirectToRoute('AfficheClubFparId', array('id' => $id));
        }
        return $this->render('FrontEndBundle:Evenement:AjoutEvenement.html.twig', array('form' => $form->createView(), "club" => $clubs));
    }


}
