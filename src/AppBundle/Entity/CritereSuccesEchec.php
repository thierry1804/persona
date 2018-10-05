<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CritereSuccesEchec
 *
 * @ORM\Table(name="critere_succes_echec")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CritereSuccesEchecRepository")
 */
class CritereSuccesEchec
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
     * @ORM\Column(name="niveau", type="string", length=255)
     */
    private $niveau;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="couleur", type="string", length=10)
     */
    private $couleur;

    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="CasTest", mappedBy="critereSuccesEchec", cascade={"persist", "remove"})
     */
    private $casTests;

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
     * Set niveau
     *
     * @param string $niveau
     *
     * @return CritereSuccesEchec
     */
    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * Get niveau
     *
     * @return string
     */
    public function getNiveau()
    {
        return $this->niveau;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return CritereSuccesEchec
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set couleur
     *
     * @param string $couleur
     *
     * @return CritereSuccesEchec
     */
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * Get couleur
     *
     * @return string
     */
    public function getCouleur()
    {
        return $this->couleur;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->casTests = new ArrayCollection();
    }

    /**
     * Add casTest
     *
     * @param \AppBundle\Entity\CasTest $casTest
     *
     * @return CritereSuccesEchec
     */
    public function addCasTest(\AppBundle\Entity\CasTest $casTest)
    {
        $casTest->setCritereSuccesEchec($this);
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
}
