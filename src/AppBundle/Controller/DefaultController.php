<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * Listing des projets et statistiques
     * @Template("default/index.html.twig")
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        //Les critères
        $criteres = $em->getRepository("AppBundle:CritereSuccesEchec")->findAll();
        //Les projets
        $projets = $em->getRepository("AppBundle:Projet")->findAll();
        
        return array(
            'criteres' => $criteres,
            'projets' => $projets,
        );
    }
}
