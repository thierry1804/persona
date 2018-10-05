<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CampagneController extends Controller
{
    
    /**
     * Listing des campagnes
     * @Template("campagne/index.html.twig")
     * @Route("/campagnes", name="index-campagne")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        //Liste des campagnes
        $campagnes = $em->getRepository("AppBundle:Campagne")->findAll();
        
        return array(
            'campagnes' => $campagnes,
        );
    }
    
}
