<?php
/**
 * Created by PhpStorm.
 * User: plazma33
 * Date: 11/15/2017
 * Time: 2:48 AM
 */

namespace FrontEndBundle\Controller;

use EspritForAll\BackEndBundle\Entity\Commande;
use EspritForAll\BackEndBundle\Entity\LigneCommande;
use EspritForAll\BackEndBundle\Entity\Menu;
use function MongoDB\BSON\toJSON;
use Symfony\Bridge\PhpUnit\Legacy\Command;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use log;



class RestaurentMenuController extends Controller
{

    public function cotegoriesAction(){

        return $this->render('FrontEndBundle:Restaurent:MenuCategories.html.twig');

    }

    public function ClickOnSubCategoryAction($type){
        $em = $this->getDoctrine()->getManager();
        $menu = $em->getRepository("EspritForAllBackEndBundle:Menu")->findBy(array('type' => $type));
        return $this->render('FrontEndBundle:Restaurent:MenuSubCategories.html.twig', array('menu' => $menu));
    }

    public function GetDataFromCardAction(Request $request){
        $data = json_decode( $request->getContent());
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
        $comm=$em->getRepository("EspritForAllBackEndBundle:Commande")->findBy(array('user'=>$user));

        //testing if the user does not have any order with 0 orders , in this case an order will be created
        if ($comm!=null){
            $test_order=false;
            foreach ($comm as $t){
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
        //getting the latest order that belongs to the user and with no meals ordered
        $ti=new Commande();
        foreach ($comm as $t){
            if ($t->getPrix()==0){
                $ti=$t;
            }
        }
        $price=0;
        //inserting the meals that are associated to the order
        foreach ($data as $obj){
            $s=new LigneCommande();
            $s->setQuantite($obj->quantite);
            $s->setMenu($em->find(Menu::class,$obj->id_menu));
            $s->setCommande($ti);
            //checking if there is a similar meals ordered in the same order-id ad men-id
            $test=$em->getRepository("EspritForAllBackEndBundle:LigneCommande")->findBy(array('menu' =>$em->find(Menu::class,$obj->id_menu) ,'commande'=>$ti));
            if( $test == null){
                $em->persist($s);
                $em->flush();
            }
            //calculating the order total price
            $price+=($obj->prix)*($obj->quantite);
        }
        //setting the order price
        $ti->setPrix($price);
        $em->persist($ti);
        $em->flush();




        return $this->json(null,200);
    }



    public function GetMenusAction(Request $request){

        $em = $this->getDoctrine()->getManager();
        $data=$em->getRepository("EspritForAllBackEndBundle:Menu")->findAll();

        return $this->json($data,200);
    }


}