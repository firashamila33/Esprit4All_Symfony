<?php
/**
 * Created by PhpStorm.
 * User: plazma33
 * Date: 11/23/2017
 * Time: 3:04 AM
 */

namespace EspritForAll\BackEndBundle\Controller;
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

    public function UpdateLSAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $menu = $em->getRepository("EspritForAllBackEndBundle:Menu")->findAll();
        return $this->json($menu,200);
    }
}
