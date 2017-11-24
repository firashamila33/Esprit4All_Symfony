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

    public function cotegoriesAction()
    {

        return $this->render('FrontEndBundle:Restaurent:MenuCategories.html.twig');

    }

    public function ClickOnSubCategoryAction($type)
    {
        $em = $this->getDoctrine()->getManager();
        $menu = $em->getRepository("EspritForAllBackEndBundle:Menu")->findBy(array('type' => $type));
        return $this->render('FrontEndBundle:Restaurent:MenuSubCategories.html.twig', array('menu' => $menu));
    }

    public function GetDataFromCardAction(Request $request)
    {
        $data = json_decode( $request->getContent());
        $em = $this->getDoctrine()->getManager();

        foreach ($data as $obj){

            $s=new LigneCommande();
            $s->setQuantite($obj->quantite);
            $s->setMenu($em->find(Menu::class,$obj->id_menu));
            $s->setCommande($em->find(Commande::class,4));
            $test=$em->getRepository("EspritForAllBackEndBundle:LigneCommande")
                ->findBy(array('menu' =>$em->find(Menu::class,$obj->id_menu) ,'commande'=>4));
            if( $test == null){
                $em->persist($s);
                $em->flush();
            }
        }
        return $this->json(null,200);
    }


}