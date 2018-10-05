<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\CasTest;
use AppBundle\Form\RecetteType;

/**
 * Description of RecetteController
 *
 * @author thierry
 */
class RecetteController extends Controller
{
    
    /**
     * Liste des recettes disponibles
     * @Template("recette/index.html.twig")
     * @Route("/recettes", name="index-recette")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        //Les cas de test possibles
        $recettes = $em->getRepository("AppBundle:CasTest")->getRecettes();
        
        return array(
            'recettes' => $recettes,
        );
    }
    
    /**
     * Action de recetter
     * @Template("recette/do.html.twig")
     * @Route("/recetter/{id}", name="do-recette")
     */
    public function recetterAction(Request $request, CasTest $casTest)
    {
        //Un cas de test déjà testé ne peut plus être modifé
        $readOnly = !is_null($casTest->getTesteur());
        if (!$readOnly) {
            //Définir au préalable le testeur
            $casTest->setTesteur($this->getUser());
            //Définir au préalable la date de l'opération de test
            $casTest->setFin(new \DateTime());
        }
        $form = $this->createForm(RecetteType::class, $casTest, array(
            'readonly' => $readOnly,
        ));
        $em = $this->getDoctrine()->getManager();
        
        if ($request->isMethod("POST")) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($casTest);
                $em->flush();
                
                return $this->redirectToRoute('index-recette');
            }
        }
        
        return array(
            'recette' => $casTest,
            'form' => $form->createView(),
            'readonly' => $readOnly,
        );
    }
    
}
