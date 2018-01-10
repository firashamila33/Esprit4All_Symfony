<?php
/**
 * Created by PhpStorm.
 * User: Majdi Rabie
 * Date: 09/01/2018
 * Time: 16:15
 */

namespace ApiBundle\Controller;


use EspritForAll\BackEndBundle\Entity\UtilisateurHasRevision;
use EspritForAll\BackEndBundle\Entity\Revision;
use EspritForAll\BackEndBundle\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class RevisionController extends Controller
{
    public function AllAction()
    {
        $revision = $this->getDoctrine()->getManager()
            ->getRepository('EspritForAllBackEndBundle:Revision')
            ->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted =$serializer->normalize($revision);
        return new JsonResponse($formatted);
    }

    public function AjoutAction( Request $request)
    { $revision = new Revision();
        $u = null;

        $revision->setMatiere($request->get('matiere'));
        $revision->setDescription($request->get('description'));
        $revision->setType($request->get('type'));
        $revision->setNbremax($request->get('nbremax'));


        $revision->setUser($u );
        $em = $this->getDoctrine()->getManager();
        $em->persist($revision);
        $em->flush();
        $serializer=new Serializer([new objectNormalizer()]);
        $formatted =$serializer->normalize($revision);
        return new JsonResponse($formatted);}

    public  function  rechAction(Request $request)
    {
        $request->get('matiere');

        $revision = new Revision();

        $revision->setMatiere($request->get('matiere'));


        $em = $this->getDoctrine()->getManager();


        $r= $em->getRepository("EspritForAllBackEndBundle:Revision")->findBy(array('matiere' => $revision->getMatiere()))
        ;
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted =$serializer->normalize($r);
        return new JsonResponse($formatted);
    }
    public  function  suppAction(Request $request)
    {
        $request->get('matiere');

        $revision = new Revision();

        $revision->setMatiere($request->get('matiere'));


        $em = $this->getDoctrine()->getManager();


        $r= $em->getRepository("EspritForAllBackEndBundle:Revision")->findOneBy(array('matiere' => $revision->getMatiere()))
        ;
        $em->remove($r);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted =$serializer->normalize($r);
        return new JsonResponse($formatted);
    }
    public function modifAction( Request $request)
    { $revision = new Revision();
        $u = null;
        $em = $this->getDoctrine()->getManager();
        $revision->setMatiere($request->get('matiere'));

        $r= $em->getRepository("EspritForAllBackEndBundle:Revision")->findBy(array('matiere' => $revision->getMatiere()));




        $r->setMatiere($request->get('matiere'));

        $r->setDescription($request->get('description'));
        $r->setType($request->get('type'));
        $r->setUser($u );
        $em->persist($revision);
        $em->flush();
        $serializer=new Serializer([new objectNormalizer()]);
        $formatted =$serializer->normalize($revision);
        return new JsonResponse($formatted);}


    public function AjoutRAction( Request $request)
    { $revision = new UtilisateurHasRevision();


        $em = $this->getDoctrine()->getManager();

        $r = $em->getRepository("EspritForAllBackEndBundle:User")->find($request->get('user'));
        $revision->setUser($r);
        $ur = $em->getRepository("EspritForAllBackEndBundle:Revision")->find($request->get('rev'));

        $revision->setRevision($ur);





        $em->persist($revision);
        $em->flush();
        $serializer=new Serializer([new objectNormalizer()]);
        $formatted =$serializer->normalize($revision);
        return new JsonResponse($formatted);}

    public  function  rech2Action(Request $request)
    {


        $revision = new Revision();



        $em = $this->getDoctrine()->getManager();


        $r= $em->getRepository("EspritForAllBackEndBundle:UtilisateurHasRevision")->findBy(array('user' => $request->get('has')))
        ;
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted =$serializer->normalize($r);
        return new JsonResponse($formatted);
    }
    public  function  rech3Action(Request $request)
    {


        $revision = new Revision();



        $em = $this->getDoctrine()->getManager();


        $r= $em->getRepository("EspritForAllBackEndBundle:Revision")->find($request->get('id'))
        ;
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted =$serializer->normalize($r);
        return new JsonResponse($formatted);
    }
}