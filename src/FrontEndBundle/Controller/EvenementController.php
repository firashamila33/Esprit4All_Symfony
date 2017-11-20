<?php
namespace FrontEndBundle\Controller;

use FrontEndBundle\Entity\Evenement;
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
        $evenements=$em->getRepository("FrontEndBundle:Evenement")->findBy(array(),array('id'=>'desc'));
        return $this->render('FrontEndBundle:Evenement:ListEvenement.html.twig',array("evenement"=>$evenements));
    }





}
