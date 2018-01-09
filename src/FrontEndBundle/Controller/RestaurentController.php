<?php
/**
 * Created by PhpStorm.
 * User: plazma33
 * Date: 11/9/2017
 * Time: 5:59 PM
 */
namespace FrontEndBundle\Controller;
use EspritForAll\BackEndBundle\Entity\Commande;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RestaurentController extends Controller
{

    //beside rendering the html page , this function checks if the  user is  already making his order or should it have a new one  ,
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        // creating a new order for the user in case he have now order
        $user=$em->getRepository("EspritForAllBackEndBundle:User")->findOneBy( array('id'=>$this->getUser()->getId()));
        $test_com=$em->getRepository("EspritForAllBackEndBundle:Commande")->findBy( array('user'=>$user));
        if ($test_com==null){
            $order=new  Commande();
            $order->setUser($user);
            $order->setPrix(0);
            $em->persist($order);
            $em->flush();
        }
        //if orders associated to this user are chechek by the restaurent respnsible create  new order
        else{
            $test_order=false;
            foreach ($test_com as $t){
                if ($t->getPrix()==0){
                    $test_order=true;
                }
            }
            //means that all the user orders are checked by the restaurent respnsible
            if ($test_order==false){
                $order=new  Commande();
                $order->setUser($user);
                $order->setPrix(0);
                $em->persist($order);
                $em->flush();
            }
        }
        $menu = $em->getRepository("EspritForAllBackEndBundle:Menu")->findAll();
        return $this->render('FrontEndBundle:Restaurent:RestaurentAccueil.html.twig', array('menu' => $menu,'user_id'=>$this->getUser()->getId()));
    }
}
