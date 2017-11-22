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

        $ss= new Menu();
        echo 'blaaaaaaaaaaaa';
        $ss->setQuantite($menu[0]->quantite);
        print_r($ss);
//        //TESTING THE ARRAY TO JSON CONVERTION
//        echo "<pre>";
//        print_r($menu);
//        echo "</pre>";
//
//        $JSON= json_encode($menu, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
//
//        echo "<pre>";
//        print_r($JSON);
//        echo "</pre>";
//
//        $Arr=json_decode($JSON);
//        echo "<pre>";
//        print_r($Arr);
//        echo "</pre>";


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
            $s->setCommande($em->find(Commande::class,7));
            $test=$em->getRepository("EspritForAllBackEndBundle:LigneCommande")
                ->findBy(array('menu' =>$em->find(Menu::class,$obj->id_menu) ,'commande'=>7));
            if( $test == null){
                $em->persist($s);
                $em->flush();
            }

        }

        return $this->json(null,200);
    }


}