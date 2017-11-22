<?php
/**
 * Created by PhpStorm.
 * User: majdi
 * Date: 09/11/2017
 * Time: 21:55
 */

namespace EspritForAll\BackEndBundle\Controller;


use function PHPSTORM_META\type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Ob\HighchartsBundle\Highcharts\Highchart;

use EspritForAll\BackEndBundle\Entity\Club;
use EspritForAll\BackEndBundle\Entity\Evenement;
use Symfony\Component\HttpFoundation\Request;

class GrapheController extends Controller
{
    /**
     * @Route("/")
     */
    public function chartPieAction()
    {
        $ob = new Highchart();
        $ob->chart->renderTo('piechart');
        $ob->title->text('Pourcentages des Evenements par Club');
        $ob->plotOptions->pie(array(
            'allowPointSelect' => true,
            'cursor' => 'pointer',
            'dataLabels' => array('enabled' => false),
            'showInLegend' => true
        ));
        $em = $this->container->get('doctrine')->getEntityManager();
        $clubs = $em->getRepository("EspritForAllBackEndBundle:Club")->findAll();
        $events = $em->getRepository('EspritForAllBackEndBundle:Evenement')->findAll();

        $totalEv = count($events);


        $data = array();

        foreach ($clubs as $c) {
            $stat = array();
            $eventsParC = $em->getRepository("EspritForAllBackEndBundle:Evenement")->findBy(array("club" => $c));
            array_push($stat, $c->getLibelle(), count($eventsParC) * 100 / $totalEv);

            array_push($data, $stat);
        }


        $ob->series(array(array('type' => 'pie', 'name' => 'Browser share', 'data' => $data)));
        return $this->render('EspritForAllBackEndBundle:StatistiqueEvenement:StatEvent.html.twig', array(
            'chart' => $ob
        ));

    }
}
