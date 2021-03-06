<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UtilisateurRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Utilisateur extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="CasTest", mappedBy="createur", cascade={"persist", "remove"})
     */
    private $casTests;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="CasTest", mappedBy="testeur", cascade={"persist", "remove"})
     */
    private $recettes;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Campagne", mappedBy="createur", cascade={"persist", "remove"})
     */
    private $campagnes;

    /**
     * @var \Datetime
     * @ORM\Column(name="date_modification", type="datetime", nullable=true)
     */
    private $dateModification;

    /**
     * @var \DateTime
     * @ORM\Column(name="date_fin", type="datetime", nullable=true)
     */
    private $dateFin;


    /**
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->dateModification = new \DateTime();
    }

    public function __construct() {
        parent::__construct();
        $this->casTests = new ArrayCollection();
        $this->recettes = new ArrayCollection();
        $this->campagnes = new ArrayCollection();
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
     * Set nom
     *
     * @param string $nom
     *
     * @return Utilisateur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Utilisateur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Add casTest
     *
     * @param \AppBundle\Entity\CasTest $casTest
     *
     * @return Utilisateur
     */
    public function addCasTest(\AppBundle\Entity\CasTest $casTest)
    {
        $casTest->setCreateur($this);
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

    /**
     * Add recette
     *
     * @param \AppBundle\Entity\CasTest $recette
     *
     * @return Utilisateur
     */
    public function addRecette(\AppBundle\Entity\CasTest $recette)
    {
        $recette->setTesteur($this);
        $this->recettes[] = $recette;

        return $this;
    }

    /**
     * Remove recette
     *
     * @param \AppBundle\Entity\CasTest $recette
     */
    public function removeRecette(\AppBundle\Entity\CasTest $recette)
    {
        $this->recettes->removeElement($recette);
    }

    /**
     * Get recettes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRecettes()
    {
        return $this->recettes;
    }

    /**
     * Set dateModification
     *
     * @param \DateTime $dateModification
     *
     * @return Utilisateur
     */
    public function setDateModification($dateModification)
    {
        $this->dateModification = $dateModification;

        return $this;
    }

    /**
     * Get dateModification
     *
     * @return \DateTime
     */
    public function getDateModification()
    {
        return $this->dateModification;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return Utilisateur
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Add campagne
     *
     * @param \AppBundle\Entity\Campagne $campagne
     *
     * @return Utilisateur
     */
    public function addCampagne(\AppBundle\Entity\Campagne $campagne)
    {
        $campagne->setCreateur($this);
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
