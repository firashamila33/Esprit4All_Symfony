<?php
/**
 * Created by PhpStorm.
 * User: plazma33
 * Date: 11/15/2017
 * Time: 2:48 AM
 */

namespace FrontEndBundle\Controller;
use EspritForAll\BackEndBundle\Entity\LigneCommande;
use function MongoDB\BSON\toJSON;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class RestaurentMenuController extends Controller
{
    public function cotegoriesAction()
    {
//        $em = $this->getDoctrine()->getManager();
//        $sql1 = "SELECT  ligne_commande.quantite AS Lquantite,
//                    menu.quantite AS Mquantite,
//                    menu.path_img AS Mimg,
//                    menu.prix AS Mprix,
//                    menu.libelle AS Mlibelle FROM menu
//                INNER JOIN ligne_commande ON menu.id=ligne_commande.menu_id;";
//
//        $Data = $this->getDoctrine()->getManager()->getConnection()->prepare($sql1);
//        $Data->execute();
//        $result = $Data->fetchAll();
        //return $this->render('FrontEndBundle:Restaurent:MenuCategories.html.twig',['result' => $result]);
        return $this->render('FrontEndBundle:Restaurent:MenuCategories.html.twig');

    }

    public function ClickOnSubCategoryAction($type)
    {
        $em = $this->getDoctrine()->getManager();
        $menu = $em->getRepository("EspritForAllBackEndBundle:Menu")->findBy(array('type' => $type));
//TESTING THE ARRAY TO JSON CONVERTION
//        echo "<pre>";
//        print_r($menu);
//        echo "</pre>";
//
//        $JSON= json_encode($menu, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
//
//        echo "<pre>";
//        print_r($JSON);
//        echo "</pre>";
        return $this->render('FrontEndBundle:Restaurent:MenuSubCategories.html.twig', array('menu' => $menu));

    }

    public function InsertLigneCommandeAction($id_menu,$quantite){
        $commande_id = 7;

        $em = $this->getDoctrine()->getManager();

        $menu = $em->getRepository("EspritForAllBackEndBundle:Menu")->findOneBy(array('id' => $id_menu));
        $commande=$em->getRepository("EspritForAllBackEndBundle:Commande")->findOneBy(array('id' => 7));
        $ligne_commande=$em->getRepository("EspritForAllBackEndBundle:LigneCommande")->findOneBy(array('commande' =>$commande_id, 'menu'=>$id_menu));

        if($ligne_commande==null)
        {
            $ligne_commande=new LigneCommande();
            $ligne_commande->setQuantite($quantite);
            $ligne_commande->setMenu($menu);
            $ligne_commande->setCommande($commande);

        }
        else{
            $ligne_commande->setQuantite($ligne_commande->getQuantite()+1+$quantite);
        }

        $em->persist($ligne_commande);
        $em->flush();


        return $this->render('FrontEndBundle:Restaurent:SingleProduct.html.twig', array('menu' => $menu)) ;


    }








}