<?php
/**
 * Created by PhpStorm.
 * User: Majdi Rabie
 * Date: 09/01/2018
 * Time: 16:08
 */

namespace ApiBundle\Controller;
use EspritForAll\BackEndBundle\Entity\Club;
use EspritForAll\BackEndBundle\Entity\Evenement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ClubController extends Controller
{
    public function AllClubAction()
    {
        $club = $this->getDoctrine()->getManager()->getRepository('EspritForAllBackEndBundle:Club')->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($club);
        return new JsonResponse($formatted);
    }

    public function AjoutClubAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $club = new Club();
        $club->setLibelle($request->get('libelle'));
        $club->setDescription($request->get('description'));
        $club->setPathImg($request->get('pathImg'));
        $club->setPathCouverture($request->get('pathCouverture'));
        $club->setApropos($request->get('apropos'));
        $club->setNotreHistoire($request->get('notreHistoire'));
        $em->persist($club);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($club);
        return new JsonResponse($formatted);
    }

    public function SupprimerClubAction(Request $request)
    {
        $request->get('libelle');
        $club = new Club();
        $club->setLibelle($request->get('libelle'));
        $em = $this->getDoctrine()->getManager();
        $r = $em->getRepository("EspritForAllBackEndBundle:Club")->findOneBy(array('libelle' => $club->getLibelle()));
        $em->remove($r);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($r);
        return new JsonResponse($formatted);
    }

    public function ChercherClubAction(Request $request)
    {
        $request->get('libelle');
        $club = new Club();
        $club->setLibelle($request->get('libelle'));
        $em = $this->getDoctrine()->getManager();
        $r = $em->getRepository("EspritForAllBackEndBundle:Club")->findBy(array('libelle' => $club->getLibelle()));
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($r);
        return new JsonResponse($formatted);
    }

    public function AllEvenementAction()
    {
        $event = $this->getDoctrine()->getManager()->getRepository('EspritForAllBackEndBundle:Evenement')->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($event);
        return new JsonResponse($formatted);
    }

    public function SupprimerEventAction(Request $request)
    {
        $request->get('libelle');
        $club = new Club();
        $club->setLibelle($request->get('libelle'));
        $em = $this->getDoctrine()->getManager();
        $r = $em->getRepository("EspritForAllBackEndBundle:Evenement")->findOneBy(array('libelle' => $club->getLibelle()));
        $em->remove($r);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($r);
        return new JsonResponse($formatted);
    }

    public function ProfilClubAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $club = $em->getRepository("EspritForAllBackEndBundle:Club")->find($id);
        $event = $em->getRepository("EspritForAllBackEndBundle:Evenement")->findBy(array('club' => $club));

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($event);
        return new JsonResponse($formatted);
    }

    public function StatistiqueAction(Request $request)
    {
        $JsonResponse = null;
        $em = $this->getDoctrine()->getManager();
        $clubs = $em->getRepository("EspritForAllBackEndBundle:Club")->findAll();
        foreach ($clubs as $club) {
            $event = $em->getRepository("EspritForAllBackEndBundle:Evenement")->findBy(array('club' => $club));
            $countevent = count($event);
            if ($countevent == 0) {
            } else {
                $JsonResponse["Stat"] [] = [
                    "count" => $countevent,
                    "Libelle" => $club->getLibelle()

                ];
            }
        }
        return new JsonResponse($JsonResponse);
    }
    public function AjoutEvenementAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $event = new Evenement();
        $event->setLibelle($request->get('libelle'));
        $event->setDescription($request->get('description'));
        $event->setPathImg($request->get('pathImg'));
        $event->setType($request->get('type'));
        $em->persist($event);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($event);
        return new JsonResponse($formatted);
    }
}
