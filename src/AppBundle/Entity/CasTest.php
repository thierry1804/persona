<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CasTest
 *
 * @ORM\Table(name="cas_test")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CasTestRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class CasTest
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
     * @ORM\Column(name="numero", type="string", length=255)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="objectif", type="text")
     */
    private $objectif;

    /**
     * @var string
     *
     * @ORM\Column(name="initialisation", type="text", nullable=true)
     */
    private $initialisation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fin", type="datetime", nullable=true)
     */
    private $fin;
    
    /**
     * @var Utilisateur
     * 
     * @ORM\ManyToOne(targetEntity="Utilisateur", inversedBy="casTests", cascade={"persist"})
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="createur_id", referencedColumnName="id")
     * })
     */
    private $createur;
    
    /**
     * @var Utilisateur
     * 
     * @ORM\ManyToOne(targetEntity="Utilisateur", inversedBy="recettes", cascade={"persist"})
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="testeur_id", referencedColumnName="id")
     * })
     */
    private $testeur;
    
    /**
     * @var Projet
     * 
     * @ORM\ManyToOne(targetEntity="Projet", inversedBy="casTests", cascade={"persist"})
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="projet_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $projet;
    
    /**
     * @var CritereSuccesEchec
     * 
     * @ORM\ManyToOne(targetEntity="CritereSuccesEchec", inversedBy="casTests", cascade={"persist"})
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="critere_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $critereSuccesEchec;
    
    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="Prerequis", mappedBy="casTest", cascade={"persist"})
     */
    private $prerequis;
    
    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="Batterie", mappedBy="casTest", cascade={"persist"})
     */
    private $batteries;
    
    /**
     * @var Campagne
     * 
     * @ORM\ManyToOne(targetEntity="Campagne", inversedBy="casTests", cascade={"persist"})
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="campagne_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $campagne;

    public function __construct() {
        $this->date = new \DateTime();
        $this->prerequis = new ArrayCollection();
        $this->batteries = new ArrayCollection();
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
     * Set numero
     *
     * @param string $numero
     *
     * @return CasTest
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return CasTest
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set objectif
     *
     * @param string $objectif
     *
     * @return CasTest
     */
    public function setObjectif($objectif)
    {
        $this->objectif = $objectif;

        return $this;
    }

    /**
     * Get objectif
     *
     * @return string
     */
    public function getObjectif()
    {
        return $this->objectif;
    }

    /**
     * Set initialisation
     *
     * @param string $initialisation
     *
     * @return CasTest
     */
    public function setInitialisation($initialisation)
    {
        $this->initialisation = $initialisation;

        return $this;
    }

    /**
     * Get initialisation
     *
     * @return string
     */
    public function getInitialisation()
    {
        return $this->initialisation;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return CasTest
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return CasTest
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set fin
     *
     * @param \DateTime $fin
     *
     * @return CasTest
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
     * @ORM\PostPersist
     */
    public function majFin()
    {
        $this->fin = new \DateTime();
        return $this;
    }

    /**
     * Set createur
     *
     * @param \AppBundle\Entity\Utilisateur $createur
     *
     * @return CasTest
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
     * Set testeur
     *
     * @param \AppBundle\Entity\Utilisateur $testeur
     *
     * @return CasTest
     */
    public function setTesteur(\AppBundle\Entity\Utilisateur $testeur = null)
    {
        $this->testeur = $testeur;

        return $this;
    }

    /**
     * Get testeur
     *
     * @return \AppBundle\Entity\Utilisateur
     */
    public function getTesteur()
    {
        return $this->testeur;
    }

    /**
     * Set projet
     *
     * @param \AppBundle\Entity\Projet $projet
     *
     * @return CasTest
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
     * Set critereSuccesEchec
     *
     * @param \AppBundle\Entity\CritereSuccesEchec $critereSuccesEchec
     *
     * @return CasTest
     */
    public function setCritereSuccesEchec(\AppBundle\Entity\CritereSuccesEchec $critereSuccesEchec = null)
    {
        $this->critereSuccesEchec = $critereSuccesEchec;

        return $this;
    }

    /**
     * Get critereSuccesEchec
     *
     * @return \AppBundle\Entity\CritereSuccesEchec
     */
    public function getCritereSuccesEchec()
    {
        return $this->critereSuccesEchec;
    }

    /**
     * Add prerequi
     *
     * @param \AppBundle\Entity\Prerequis $prerequi
     *
     * @return CasTest
     */
    public function addPrerequi(\AppBundle\Entity\Prerequis $prerequi)
    {
        $prerequi->setCasTest($this);
        $this->prerequis[] = $prerequi;

        return $this;
    }

    /**
     * Remove prerequi
     *
     * @param \AppBundle\Entity\Prerequis $prerequi
     */
    public function removePrerequi(\AppBundle\Entity\Prerequis $prerequi)
    {
        $this->prerequis->removeElement($prerequi);
    }

    /**
     * Get prerequis
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPrerequis()
    {
        return $this->prerequis;
    }

    /**
     * Add battery
     *
     * @param \AppBundle\Entity\Batterie $battery
     *
     * @return CasTest
     */
    public function addBattery(\AppBundle\Entity\Batterie $battery)
    {
        $battery->setCasTest($this);
        $this->batteries[] = $battery;

        return $this;
    }

    /**
     * Remove battery
     *
     * @param \AppBundle\Entity\Batterie $battery
     */
    public function removeBattery(\AppBundle\Entity\Batterie $battery)
    {
        $this->batteries->removeElement($battery);
    }

    /**
     * Get batteries
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBatteries()
    {
        return $this->batteries;
    }
    
    /**
     * Vérifie si le cahier est en lecture seule ou pas
     * @return boolean
     */
    public function isReadOnly()
    {
        //Si le cahier a été testé, alors il sera en lecture seule
        return is_object($this->testeur);
    }

    /**
     * Set campagne
     *
     * @param \AppBundle\Entity\Campagne $campagne
     *
     * @return CasTest
     */
    public function setCampagne(\AppBundle\Entity\Campagne $campagne = null)
    {
        $this->campagne = $campagne;

        return $this;
    }

    /**
     * Get campagne
     *
     * @return \AppBundle\Entity\Campagne
     */
    public function getCampagne()
    {
        return $this->campagne;
    }
}
