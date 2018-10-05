<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Projet;
use AppBundle\Form\ProjetType;

class ProjetController extends Controller
{
    /**
     * Ajouter un nouveau projet
     * @Template("projet/ajouter.html.twig")
     * @Route("/projet/ajouter", name="ajouter-projet")
     */
    public function ajouterAction(Request $request)
    {
        //Nouveau projet
        $projet = new Projet();
        $form = $this->createForm(ProjetType::class, $projet);
        
        if ($request->isMethod("POST")) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($projet);
                $em->flush();
                
                return $this->redirectToRoute('homepage');
            }
        }
        
        return array(
            'form' => $form->createView(),
        );
    }
}
