<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Campagne
 *
 * @ORM\Table(name="campagne")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CampagneRepository")
 */
class Campagne
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
     * @var \DateTime
     *
     * @ORM\Column(name="debut", type="datetime")
     */
    private $debut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fin", type="datetime", nullable=true)
     */
    private $fin;
    
    /**
     * @var Utilisateur
     * 
     * @ORM\ManyToOne(targetEntity="Utilisateur", inversedBy="campagnes", cascade={"persist"})
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="createur_id", referencedColumnName="id")
     * })
     */
    private $createur;
    
    /**
     * @var Projet
     * 
     * @ORM\ManyToOne(targetEntity="Projet", inversedBy="campagnes", cascade={"persist"})
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="projet_id", referencedColumnName="id")
     * })
     */
    private $projet;
    
    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="CasTest", mappedBy="campagne", cascade={"persist", "remove"})
     */
    private $casTests;

    public function __construct() {
        $this->debut = new \DateTime();
        $this->casTests = new ArrayCollection();
    }

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
     * @return Campagne
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
     * Set debut
     *
     * @param \DateTime $debut
     *
     * @return Campagne
     */
    public function setDebut($debut)
    {
        $this->debut = $debut;

        return $this;
    }

    /**
     * Get debut
     *
     * @return \DateTime
     */
    public function getDebut()
    {
        return $this->debut;
    }

    /**
     * Set fin
     *
     * @param \DateTime $fin
     *
     * @return Campagne
     */
    public function setFin($fin)
    {
        $this->fin = $fin;

        return $this;
    }

    /**
     * Get fin
     *
     * @return \DateTime
     */
    public function getFin()
    {
        return $this->fin;
    }

    /**
     * Set createur
     *
     * @param \AppBundle\Entity\Utilisateur $createur
     *
     * @return Campagne
     */
    public function setCreateur(\AppBundle\Entity\Utilisateur $createur = null)
    {
        $this->createur = $createur;

        return $this;
    }

    /**
     * Get createur
     *
     * @return \AppBundle\Entity\Utilisateur
     */
    public function getCreateur()
    {
        return $this->createur;
    }

    /**
     * Set projet
     *
     * @param \AppBundle\Entity\Projet $projet
     *
     * @return Campagne
     */
    public function setProjet(\AppBundle\Entity\Projet $projet = null)
    {
        $this->projet = $projet;

        return $this;
    }

    /**
     * Get projet
     *
     * @return \AppBundle\Entity\Projet
     */
    public function getProjet()
    {
        return $this->projet;
    }

    /**
     * Add casTest
     *
     * @param \AppBundle\Entity\CasTest $casTest
     *
     * @return Campagne
     */
    public function addCasTest(\AppBundle\Entity\CasTest $casTest)
    {
        $casTest->setCampagne($this);
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
