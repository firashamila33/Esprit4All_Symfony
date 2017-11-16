<?php

namespace AnnonceBundle\Controller;

use AnnonceBundle\Entity\AnnonceCoLocation;
use AnnonceBundle\Form\AnnonceCoLocationType;
use FOS\UserBundle\Model\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AnnonceCoLocationController extends Controller
{
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(AnnonceCoLocation::class);
        $list = $repo->findAll();

        return $this->render("AnnonceBundle:AnnonceCoLocation:list.html.twig", array('list' => $list));
    }

    public function addAction(Request $request)
    {
        $annonce = new AnnonceCoLocation();
        $form = $this->createForm(AnnonceCoLocationType::class, $annonce);
        if ($request->getMethod() == 'GET') {


            return $this->render("@Annonce/AnnonceCoLocation/add.html.twig",
                array('myform' => $form->createView()));

        }
        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $staticUser = $em->getRepository(\EspritForAll\BackEndBundle\Entity\User::class)->find(3);


            $annonce->setOwner($staticUser);
            $annonce->setName("");
            $annonce->setCreationDate(new \DateTime());
            $annonce->setExpirationDate(new \DateTime());
            $annonce->setDescription("");


            $em->persist($annonce);
            $em->flush();

            return $this->redirectToRoute("annonce_CoLocation_List");

        }


    }

    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $annonce = $em->getRepository("AnnonceBundle:AnnonceCoLocation")->find($id);
        $form = $this->createForm(AnnonceCoLocationType::class, $annonce);
        if ($request->getMethod() == 'GET') {





            return $this->render("@Annonce/AnnonceCoLocation/edit.html.twig",
                array('myform' => $form->createView()));

        }
        if ($form->handleRequest($request)->isValid()) {


            $em->persist($annonce);
            $em->flush();

            return $this->redirectToRoute("annonce_CoLocation_List");


        }
    }
}
