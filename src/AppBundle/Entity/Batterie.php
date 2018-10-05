<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Batterie
 *
 * @ORM\Table(name="batterie")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BatterieRepository")
 */
class Batterie
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
     * @ORM\Column(name="donnees_entrees", type="text")
     */
    private $donneesEntrees;

    /**
     * @var string
     *
     * @ORM\Column(name="comportement_attendu", type="text")
     */
    private $comportementAttendu;

    /**
     * @var bool
     *
     * @ORM\Column(name="ok", type="boolean")
     */
    private $ok;

    /**
     * @var CasTest
     * 
     * @ORM\ManyToOne(targetEntity="CasTest", inversedBy="batteries", cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="cas_test_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $casTest;
    
    public function __construct() {
        $this->ok = FALSE;
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
     * Set donneesEntrees
     *
     * @param string $donneesEntrees
     *
     * @return Batterie
     */
    public function setDonneesEntrees($donneesEntrees)
    {
        $this->donneesEntrees = $donneesEntrees;

        return $this;
    }

    /**
     * Get donneesEntrees
     *
     * @return string
     */
    public function getDonneesEntrees()
    {
        return $this->donneesEntrees;
    }

    /**
     * Set comportementAttendu
     *
     * @param string $comportementAttendu
     *
     * @return Batterie
     */
    public function setComportementAttendu($comportementAttendu)
    {
        $this->comportementAttendu = $comportementAttendu;

        return $this;
    }

    /**
     * Get comportementAttendu
     *
     * @return string
     */
    public function getComportementAttendu()
    {
        return $this->comportementAttendu;
    }

    /**
     * Set ok
     *
     * @param boolean $ok
     *
     * @return Batterie
     */
    public function setOk($ok)
    {
        $this->ok = $ok;

        return $this;
    }

    /**
     * Get ok
     *
     * @return bool
     */
    public function getOk()
    {
        return $this->ok;
    }

    /**
     * Set casTest
     *
     * @param \AppBundle\Entity\CasTest $casTest
     *
     * @return Batterie
     */
    public function setCasTest(\AppBundle\Entity\CasTest $casTest = null)
    {
        $this->casTest = $casTest;

        return $this;
    }

    /**
     * Get casTest
     *
     * @return \AppBundle\Entity\CasTest
     */
    public function getCasTest()
    {
        return $this->casTest;
    }
}
