<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\CritereSuccesEchec;

/**
 * Description of LoadFixtures
 *
 * @author thierry
 */
class LoadFixtures extends Fixture implements ContainerAwareInterface {
    
    private $container;
    
    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }


    public function load(ObjectManager $manager)
    {
        $this->ajouterUser();
        $this->ajouterCriteres($manager);
    }
    
    private function ajouterCriteres(ObjectManager $em)
    {
        $criteres = array(
            array(
                "niveau" => "faible",
                "description" => "au moins un des cas n'a pas pu être réalisé et empêche la poursuite des tests",
                "couleur" => "#e81919",
            ),
            array(
                "niveau" => "moyen",
                "description" => "au moins un des cas n'a pas pu être réalisé",
                "couleur" => "#e87918",
            ),
            array(
                "niveau" => "bon",
                "description" => "des erreurs sont apparues mais ont pu être contournées",
                "couleur" => "#18e8e8",
            ),
            array(
                "niveau" => "excellent",
                "description" => "tous les cas de test se sont déroulés sans le moindre problème",
                "couleur" => "#18e826",
            ),
        );
        
        foreach ($criteres as $critere) {
            $critereSuccesEchec = new CritereSuccesEchec();
            $critereSuccesEchec->setNiveau($critere['niveau']);
            $critereSuccesEchec->setDescription($critere['description']);
            $critereSuccesEchec->setCouleur($critere['couleur']);
            
            $em->persist($critereSuccesEchec);
        }
        
        $em->flush();
    }
    
    private function ajouterUser()
    {
        $userManager = $this->container->get('fos_user.user_manager');
        
        $user = $userManager->createUser();
        $user->setUsername("admin");
        $user->setEmail("admin@makeyservices.com");
        $user->setPlainPassword("admin");
        $user->setEnabled(true);
        
        $userManager->updateUser($user, true);
    }

}
