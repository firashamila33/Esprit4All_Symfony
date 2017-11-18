<?php
/**
 * Created by PhpStorm.
 * User: plazma33
 * Date: 11/9/2017
 * Time: 5:59 PM
 */
namespace FrontEndBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class RestaurentController extends Controller
{
    public function indexAction()
    {
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
        //$this->get('session')->set('result_p',['result' => $result]);
        $session = $this->get('session');
        $session->set('result_p', array('result' => $result));
        return $this->render('FrontEndBundle:Restaurent:RestaurentAccueil.html.twig', ['result' => $result]);
    }


}