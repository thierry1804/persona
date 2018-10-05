<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Projet
 *
 * @ORM\Table(name="projet")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjetRepository")
 */
class Projet
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="CasTest", mappedBy="projet", cascade={"persist", "remove"})
     */
    private $casTests;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Campagne", mappedBy="projet", cascade={"persist", "remove"})
     */
    private $campagnes;
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Projet
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->casTests = new ArrayCollection();
        $this->campagnes = new ArrayCollection();
    }

    /**
     * Add casTest
     *
     * @param \AppBundle\Entity\CasTest $casTest
     *
     * @return Projet
     */
    public function addCasTest(\AppBundle\Entity\CasTest $casTest)
    {
        $casTest->setProjet($this);
        $this->casTests[] = $casTest;

        return $this;
    }

    /**
     * Remove casTest
     *
     * @param \AppBundle\Entity\CasTest $casTest
     */
    public function removeCasTest(\AppBundle\Entity\CasTest $casTest)
    {
        $this->casTests->removeElement($casTest);
    }

    /**
     * Get casTests
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCasTests()
    {
        return $this->casTests;
    }
    
    public function getStatistique()
    {
        $stat = array();
        foreach ($this->getCasTests() as $casTest) {
            if (is_object($casTest->getCritereSuccesEchec())) {
                if (isset($stat[$casTest->getCritereSuccesEchec()->getId()])) {
                    $stat[$casTest->getCritereSuccesEchec()->getId()]++;
                }
                else {
                    $stat[$casTest->getCritereSuccesEchec()->getId()] = 1;
                }
            }
        }
        return $stat;
    }

    /**
     * Add campagne
     *
     * @param \AppBundle\Entity\Campagne $campagne
     *
     * @return Projet
     */
    public function addCampagne(\AppBundle\Entity\Campagne $campagne)
    {
        $campagne->setProjet($this);
        $this->campagnes[] = $campagne;

        return $this;
    }

    /**
     * Remove campagne
     *
     * @param \AppBundle\Entity\Campagne $campagne
     */
    public function removeCampagne(\AppBundle\Entity\Campagne $campagne)
    {
        $this->campagnes->removeElement($campagne);
    }

    /**
     * Get campagnes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCampagnes()
    {
        return $this->campagnes;
    }
}
