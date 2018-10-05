<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Utilisateur;
use AppBundle\Form\UtilisateurType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of UtilisateurController
 *
 * @author Fenomanana
 * @Route("utilisateur", name="utilisateur_")
 */
class UtilisateurController extends Controller
{

    /**
     *
     * @Route("s", name="liste")
     * @Template("utilisateur/index.html.twig")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository("AppBundle:Utilisateur")->findAll();

        return array(
            "users" => $users
        );
    }

    /**
     * @Route("/ajouter", name="ajouter")
     * @Template("utilisateur/ajouter.html.twig")
     * @param Request $request
     */
    public function ajouterAction(Request $request)
    {
        $user = new Utilisateur();
        $form = $this->createForm(UtilisateurType::class, $user);
        $form->handleRequest($request);
        if ($request->isMethod('POST')) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $data = $request->get('appbundle_utilisateur');
                $password = $form->getData()->getPassword();
                $user->setUsername($data['login']);
                $user->setUsernameCanonical($data['login']);
                $user->setPlainPassword($password);
                $user->setEnabled(true);
                $em->persist($user);
                $em->flush();
            } else {
                echo "les champs mot de passe doivent correspondre.";
            }
            return $this->redirect($this->generateUrl('utilisateur_liste'));
        }

        return array(
            'form' => $form->createView()
        );
    }

    /**
     * @Route("/{id}/modifier", name="modifier")
     * @Template("utilisateur/modifier.html.twig")
     * @param Request $request
     * @param Utilisateur $user
     */
    public function modifierAction(Request $request, Utilisateur $user)
    {
        $pswd = $user->getPassword();
        $form = $this->createForm(UtilisateurType::class, $user);
        $form->handleRequest($request);
        if ($request->isMethod('POST')) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $data = $request->get('appbundle_utilisateur');
                if (!isset($data['password']['first']) && !isset($data['password']['second'])) {
                    $user->setPassword($pswd);
                } else {
                    $user->setPlainPassword($data['password']['first']);
                }
                $login = $data['login'];
                $user->setUsername($login);
                $user->setUsernameCanonical($login);
                $em->persist($user);
                $em->flush();
            } else {
                echo "les champs mot de passe doivent correspondre.";
            }
            return $this->redirect($this->generateUrl('utilisateur_liste'));
        }
        return array(
            'form' => $form->createView(),
            'user' => $user
        );
    }

    /**
     * @Route("/{id}/supprimer", name="supprimer")
     * @param Utilisateur $user
     */
    public function supprimerAction(Utilisateur $user)
    {
        $em = $this->getDoctrine()->getManager();
        $user->setDateFin(new \DateTime());
        $em->persist($user);
        $em->flush();

        return $this->redirect($this->generateUrl('utilisateur_liste'));
    }
}
