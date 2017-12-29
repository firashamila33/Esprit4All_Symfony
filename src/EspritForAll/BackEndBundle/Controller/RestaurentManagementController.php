<?php
/**
 * Created by PhpStorm.
 * User: plazma33
 * Date: 11/23/2017
 * Time: 3:04 AM
 */

namespace EspritForAll\BackEndBundle\Controller;
use EspritForAll\BackEndBundle\Entity\Commande;
use EspritForAll\BackEndBundle\Entity\LigneCommande;
use EspritForAll\BackEndBundle\Entity\Menu;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class RestaurentManagementController extends Controller
{

    public function indexAction()
    {
        return $this->render('EspritForAllBackEndBundle:Restaurent:RestaurentBackOfficeMeals.html.twig');
    }
    public function EditMenuAction(Request $request)
    {
        $obj = json_decode( $request->getContent());
        $em = $this->getDoctrine()->getManager();


            $menu = $em->getRepository("EspritForAllBackEndBundle:Menu")->find(array('id' => $obj->id));
            $menu->setLibelle($obj->libelle);
            $menu->setPrix($obj->prix);
            $menu->setQuantite($obj->quantite);
            $menu->setCategorie($obj->categorie);
            $menu->setType($obj->type);
            $menu->setDisponibilite($obj->disponibilite);
            $em->persist($menu);
            $em->flush();


        return $this->json(null,200);


    }
    public function DeleteMenuAction(Request $request)
    {
        $obj = json_decode( $request->getContent());
        $em = $this->getDoctrine()->getManager();
        $menu=$em->getRepository("EspritForAllBackEndBundle:Menu")->findOneBy(array('id' => $obj->id));
        $em->remove($menu);
        $em->flush();
        return $this->json(null,200);
    }

    //adding a new menu
    public function AddMenuAction(Request $request)
    {
        $obj = json_decode( $request->getContent());
        $menu=new Menu();
        $em = $this->getDoctrine()->getManager();
        $menu_test=$em->getRepository("EspritForAllBackEndBundle:Menu")->findOneBy(array('libelle' => $obj->libelle));
        if($menu_test==0){
            $menu->setLibelle($obj->libelle);
            $menu->setPrix($obj->prix);
            $menu->setQuantite($obj->quantite);
            $menu->setCategorie($obj->categorie);
            $menu->setType($obj->type);
            $menu->setDisponibilite($obj->disponibilite);
            $em->persist($menu);
            $em->flush();
        }
        else{$obj=[];}

        return $this->json($obj,200);
    }

    //this function return all the existant peals in "menu" table in JSON FORMAT
    public function UpdateLSAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $menu = $em->getRepository("EspritForAllBackEndBundle:Menu")->findAll();
        return $this->json($menu,200);
    }
    //this function returen all the Pending order to the Resturent Manager
    public  function OrdersAction(){

        $em = $this->getDoctrine()->getManager();
        $commande = $em->getRepository("EspritForAllBackEndBundle:Commande")->findAll();
        $ligne_commande= $em->getRepository("EspritForAllBackEndBundle:LigneCommande")->findAll();
        $menu= $em->getRepository("EspritForAllBackEndBundle:Menu")->findAll();
        $users=$em->getRepository("EspritForAllBackEndBundle:User")->findAll();

        return $this->render('EspritForAllBackEndBundle:Restaurent:RestaurentOrders.html.twig',array('lcomande'=>$ligne_commande,'comande'=>$commande,'menu'=>$menu,'users'=>$users));
    }

    //this function is called when the Restaurent Manager checks an order , in  this case , the order price is multiplied by -1 to mark it
    public function CheckOrderAction(Request $request)
    {
        $id_comm = (int)( $request->getContent());
        $em = $this->getDoctrine()->getManager();

        $commande=$em->getRepository("EspritForAllBackEndBundle:Commande")->find($id_comm);

        if ($commande!=null){
            $commande->setPrix($commande->getPrix()*-1);
            $em->flush($commande);
            $em->persist();
        }

        return $this->json(null,200);
    }

    //this function will respond to a Ajax request by the new order to be rendered to the Restaurent manager dashbord (used for real time interaton)
    public function CheckNewOrderAction(Request $request)
    {
        $new_order_id=0;
        $em = $this->getDoctrine()->getManager();
        $orders=$em->getRepository("EspritForAllBackEndBundle:Commande")->findAll();
        foreach ($orders as $o){
            if ($o->getPrix()>0){
                $new_order_id=$o->getId();
            }
        }
        return $this->json($new_order_id,200);
    }

    //Creating a custom array from data getted from two database tables
    public function GetOrderAction(Request $request)
    {
        $new_order_id=$request->getContent();
        $list=array();
        $em=$this->getDoctrine()->getManager();
        $order=$em->getRepository("EspritForAllBackEndBundle:Commande")->findOneBy(array("id"=>$new_order_id));
        $order_meals=$em->getRepository("EspritForAllBackEndBundle:LigneCommande")->findBy(array("commande"=>$order));
        foreach ($order_meals as $or){
            $row_array['quantite'] = $or->getQuantite();
            $row_array['menu'] = $em->getRepository("EspritForAllBackEndBundle:Menu")->findOneBy(array('id'=>$or->getMenu()));
            array_push($list,$row_array);

        }
        $resp["order"]=$order;
        $resp["meals"]=$list;
        return $this->json($resp,200);
    }




}
