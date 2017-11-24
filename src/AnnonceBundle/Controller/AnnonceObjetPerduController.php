<?php

namespace AnnonceBundle\Controller;

use AnnonceBundle\Entity\AnnonceCoLocation;
use AnnonceBundle\Entity\AnnonceObjetPerdu;
use AnnonceBundle\Form\AnnonceCoLocationType;
use AnnonceBundle\Form\AnnonceObjetPerduType;
use FOS\UserBundle\Model\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AnnonceObjetPerduController extends Controller
{
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(AnnonceObjetPerdu::class);
        $list = $repo->findAll();

        return $this->render("AnnonceBundle:AnnonceObjetPerdu:list.html.twig", array('list' => $list));
    }

    public function addAction(Request $request)
    {
        $annonce = new AnnonceObjetPerdu();
        $form = $this->createForm(AnnonceObjetPerduType::class, $annonce);
        if ($request->getMethod() == 'GET') {


            return $this->render("@Annonce/AnnonceObjetPerdu/add.html.twig",
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

            return $this->redirectToRoute("annonce_ObjetPerdu_List");

        }


    }

    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $annonce = $em->getRepository("AnnonceBundle:AnnonceObjetPerdu")->find($id);
        $form = $this->createForm(AnnonceObjetPerduType::class, $annonce);
        if ($request->getMethod() == 'GET') {





            return $this->render("@Annonce/AnnonceObjetPerdu/edit.html.twig",
                array('myform' => $form->createView()));

        }
        if ($form->handleRequest($request)->isValid()) {


            $em->persist($annonce);
            $em->flush();

            return $this->redirectToRoute("annonce_ObjetPerdu_List");


        }
    }
}
