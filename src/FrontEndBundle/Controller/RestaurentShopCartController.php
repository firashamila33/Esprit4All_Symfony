<?php
/**
 * Created by PhpStorm.
 * User: plazma33
 * Date: 11/15/2017
 * Time: 2:18 AM
 */

namespace FrontEndBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class RestaurentShopCartController extends Controller
{
    public function indexAction()
    {
        return $this->render('FrontEndBundle:Restaurent:ShopCart.html.twig');
    }

    public function ShowUserCardAction(){

        $em = $this->getDoctrine()->getManager();
        $sql1 = "SELECT  ligne_commande.quantite AS Lquantite,
                    menu.quantite AS Mquantite,
                    menu.path_img AS Mimg,
                    menu.prix AS Mprix,
                    menu.libelle AS Mlibelle FROM menu 
                INNER JOIN ligne_commande ON menu.id=ligne_commande.menu_id;";
        $Data = $this->getDoctrine()->getManager()->getConnection()->prepare($sql1);
        $Data->execute();
        $result = $Data->fetchAll();
        return $this->render('FrontEndBundle:Restaurent:ShopCart.html.twig', ['result' => $result]);


    }
}