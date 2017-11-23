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



            $annonce->setOwner($this->getUser());
            $annonce->setName("");
            $annonce->setCreationDate(new \DateTime());
            $annonce->setExpirationDate(new \DateTime());
            $annonce->setDescription("");

            foreach ($annonce->getPhotos() as $pic) {
                $pic->upload();
            }


            $em->persist($annonce);
            $em->flush();

            return $this->redirectToRoute("annonce_CoLocation_List");

        }
        return new Response("Form is Not Valid you messed up");


    }

    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $annonce = $em->getRepository("AnnonceBundle:AnnonceCoLocation")->find($id);
        $form = $this->createForm(AnnonceCoLocationType::class, $annonce);
        if ($request->getMethod() == 'GET') {


            return $this->render("@Annonce/AnnonceCoLocation/edit.html.twig",
                array('myform' => $form->createView(), 'annonce' => $annonce));

        }
        if ($form->handleRequest($request)->isValid()) {


            $em->persist($annonce);
            $em->flush();

            return $this->redirectToRoute("annonce_CoLocation_List");


        }
    }

    public function viewAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $annonce = $em->getRepository("AnnonceBundle:AnnonceCoLocation")->find($id);
        return $this->render("@Annonce/AnnonceCoLocation/view.html.twig", array('annonce' => $annonce));

    }

    public function newDemandeurAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $annonce = $em->getRepository("AnnonceBundle:AnnonceCoLocation")->find($id);
        $annonce->addDemandeur($this->getUser());
        $em->flush();
        return $this->redirectToRoute("annonce_CoLocation_View", array('id' => $id));


    }

    public function accepterDemandeurAction($id_annonce, $id_user)
    {
        $em = $this->getDoctrine()->getManager();
        $annonce = $em->getRepository("AnnonceBundle:AnnonceCoLocation")->find($id_annonce);

        $user = $em->getRepository(\EspritForAll\BackEndBundle\Entity\User::class)->find($id_user);

        if ($annonce->getDemandeurs()->contains($user)) {
            $annonce->removeDemandeur($user);
            $annonce->addCoLocataire($user);

        }


        $em->flush();

        return $this->redirectToRoute("annonce_CoLocation_View", array('id' => $id_annonce));

    }

    public function refuserDemandeurAction($id_annonce, $id_user)
    {
        $em = $this->getDoctrine()->getManager();
        $annonce = $em->getRepository("AnnonceBundle:AnnonceCoLocation")->find($id_annonce);

        $user = $em->getRepository(\EspritForAll\BackEndBundle\Entity\User::class)->find($id_user);
        if ($annonce->getDemandeurs()->contains($user)) {
            $annonce->removeDemandeur($user);

        }
        $em->flush();

        return $this->redirectToRoute("annonce_CoLocation_View", array('id' => $id_annonce));


    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $annonce = $em->getRepository("AnnonceBundle:AnnonceCoLocation")->find($id);
        $em->remove($annonce);
        $em->flush();

        return $this->redirectToRoute("annonce_CoLocation_List");

    }


}
