<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Prerequis
 *
 * @ORM\Table(name="prerequis")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PrerequisRepository")
 */
class Prerequis
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
     * @ORM\Column(name="item", type="string", length=255)
     */
    private $item;

    /**
     * @var bool
     *
     * @ORM\Column(name="ok", type="boolean")
     */
    private $ok;

    /**
     * @var CasTest
     * 
     * @ORM\ManyToOne(targetEntity="CasTest", inversedBy="prerequis", cascade={"persist", "remove"})
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
     * Set item
     *
     * @param string $item
     *
     * @return Prerequis
     */
    public function setItem($item)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * Get item
     *
     * @return string
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * Set ok
     *
     * @param boolean $ok
     *
     * @return Prerequis
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
     * @return Prerequis
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
