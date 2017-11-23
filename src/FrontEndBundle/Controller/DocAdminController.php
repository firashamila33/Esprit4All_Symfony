<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 17/11/2017
 * Time: 12:59
 */

namespace FrontEndBundle\Controller;


use EspritForAll\BackEndBundle\Entity\Documentadministratif;
use EspritForAll\BackEndBundle\Entity\Revision;
use EspritForAll\BackEndBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class DocAdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('FrontEndBundle:Doc:docAcceuil.html.twig');
    }

    public function Ajout1Action(Request $request)
    {
        $Doc = new Documentadministratif();

        $u = new User();
        $Rev = new Revision();
        if ($request->isMethod('POST')){
            $Doc->setType($request->get('typedoc'));

        $Doc->setQuantite("1");
        $Doc->setConfirmation("true");


        $u = new User();
        $Doc->setUser($u->getId());

        $em = $this->getDoctrine()->getManager();
        $em->persist($Doc);
        $em->flush();}

        return $this->render('FrontEndBundle:Doc:docAcceuil.html.twig');

    }






}