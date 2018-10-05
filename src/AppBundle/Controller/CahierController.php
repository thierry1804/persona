<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormInterface;
use AppBundle\Entity\Projet;
use AppBundle\Entity\CasTest;
use AppBundle\Form\CasTestType;

class CahierController extends Controller
{
    
    /**
     * Listing des cahiers de recettes par projet
     * @Template("cahier/index.html.twig")
     * @Route("/projet/{id}/recettes", name="index-cahier")
     */
    public function indexAction(Projet $projet)
    {
        $em = $this->getDoctrine()->getManager();
        //Les projets à afficher à gauche
        $projets = $em->getRepository("AppBundle:Projet")->findAll();
        //Liste des cahiers de recette
        $cahiers = $em->getRepository("AppBundle:CasTest")->findBy(array('projet' => $projet), array('date' => 'DESC'));
        
        return array(
            'projet' => $projet,
            'projets' => $projets,
            'cahiers' => $cahiers,
        );
    }
    
    /**
     * Création d'un nouveau cas de test
     * @Template("cahier/ajouter.html.twig")
     * @Route("/projet/{id}/ajouter-cas-de-test", name="ajouter-cahier")
     * @param Request $request
     */
    public function ajouterAction(Request $request, Projet $projet)
    {
        //Nouveau cahier de recette
        $cahier = new CasTest();
        //L'associer au projet passé en paramètre
        $cahier->setProjet($projet);
        //Définir le créateur
        $cahier->setCreateur($this->getUser());
        $form = $this->createForm(CasTestType::class, $cahier);
        
        if ($request->isMethod("POST")) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($cahier);
                $em->flush();
                
                return $this->redirectToRoute('index-cahier', array('id' => $projet->getId()));
            }
        }
        
        return array(
            'projet' => $projet,
            'form' => $form->createView(),
        );
    }
    
    /**
     * Modifier un cas de test
     * @Template("cahier/editer.html.twig")
     * @Route("/cahier/{id}", name="editer-cahier")
     * @param Request $request
     */
    public function editerAction(Request $request, CasTest $casTest)
    {
        //Un cas de test déjà testé ne peut plus être modifé
        $readOnly = !is_null($casTest->getTesteur());
        $form = $this->createForm(CasTestType::class, $casTest, array(
            'readonly' => $readOnly,
        ));
        
        //Liste des prérequis originaux du cas de test
        $prerequisOriginaux = $this->trouverCollection($casTest->getPrerequis());
        //Liste des batteries de test originals
        $batteriesOriginales = $this->trouverCollection($casTest->getBatteries());
        
        if ($request->isMethod("POST")) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                //Si un ou plusieurs prérequis ou batteries ont été supprimés
                //il faut les supprimer dans la base
                $this->supprimerElementInconnu($em, $casTest, $form, $prerequisOriginaux, $batteriesOriginales);

                $em->persist($casTest);
                $em->flush();
                
                return $this->redirectToRoute('index-cahier', array('id' => $casTest->getProjet()->getId()));
            }
        }
        
        return array(
            'cahier' => $casTest,
            'form' => $form->createView(),
        );
    }
    
    /**
     * Supprimer un cas de test
     * @Route("/cahier/{id}/supprimer", name="supprimer-cahier")
     * @param CasTest $casTest
     */
    public function supprimerAction(CasTest $casTest)
    {
        $idProjet = $casTest->getProjet()->getId();
        
        //Si le cas n'a pas encore testé
        if (!is_object($casTest->getTesteur())) {
            $em = $this->getDoctrine()->getManager();
            //Supprimer toutes les batteries
            foreach ($casTest->getBatteries() as $batterie) {
                $em->remove($batterie);
            }
            //Supprimer tous les prérequis
            foreach ($casTest->getPrerequis() as $prerequis) {
                $em->remove($prerequis);
            }
            //Supprimer le cas de test
            $em->remove($casTest);
            $em->flush();
        }
        return $this->redirectToRoute('index-cahier', array('id' => $idProjet));
    }
    
    /**
     * Populer une collection
     * @param array $collections
     * @return ArrayCollection
     */
    private function trouverCollection($collections)
    {
        $arrayCols = new ArrayCollection();
        foreach ($collections as $element) {
            $arrayCols->add($element);
        }
        return $arrayCols;
    }
    
    /**
     * Supprimer les éventuels prérequis et/ou batteries de test inconnus
     * @param ObjectManager $em
     * @param CasTest $casTest
     * @param FormInterface $form
     * @param ArrayCollection $prerequisOriginaux
     * @param ArrayCollection $batteriesOriginales
     */
    private function supprimerElementInconnu(ObjectManager &$em, CasTest &$casTest, FormInterface $form, ArrayCollection $prerequisOriginaux, ArrayCollection $batteriesOriginales)
    {
        //Supprimer les éventuels prérequis inexistants
        foreach ($prerequisOriginaux as $prerequis) {
            if (FALSE === $form->getData()->getPrerequis()->contains($prerequis)) {
                $casTest->removePrerequi($prerequis);
                $em->remove($prerequis);
            }
        }
        
        //Supprimer les éventuelles batteries inexistantes
        foreach ($batteriesOriginales as $batterie) {
            if (FALSE === $form->getData()->getBatteries()->contains($batterie)) {
                $casTest->removeBattery($batterie);
                $em->remove($batterie);
            }
        }
    }
    
}
