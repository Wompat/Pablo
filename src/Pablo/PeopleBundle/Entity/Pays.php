<?php

namespace Pablo\PeopleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Pays
 * @package Pablo\PeopleBundle\Entity
 *
 * @ORM\Table(name="pays")
 * @ORM\Entity(repositoryClass="Pablo\PeopleBundle\Entity\PaysRepository")
 */
class Pays
{
    /**
     * @var string
     *
     * @ORM\Column(name="codepays", type="string", length=2)
     * @ORM\Id
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=120)
     */
    private $nom;

    /**
     * @var integer
     *
     * @ORM\Column(name="codefwb", type="integer")
     */
    private $codeFWB;

    /**
     * @var \Pablo\PeopleBundle\Entity\Pays
     *
     * @ORM\ManyToOne(targetEntity="Pablo\PeopleBundle\Entity\Pays")
     * @ORM\JoinColumn(name="codecontinent", referencedColumnName="codepays")
     */
    private $continent;

    /**
     * Set code
     *
     * @param string $code
     * @return Pays
     */
    public function setCode($code)
    {
        $this->code = $code;
    
        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Pays
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
     * Set codeFWB
     *
     * @param integer $codeFWB
     * @return Pays
     */
    public function setCodeFWB($codeFWB)
    {
        $this->codeFWB = $codeFWB;
    
        return $this;
    }

    /**
     * Get codeFWB
     *
     * @return integer 
     */
    public function getCodeFWB()
    {
        return $this->codeFWB;
    }

    /**
     * Set continent
     *
     * @param \Pablo\PeopleBundle\Entity\Pays $continent
     * @return Pays
     */
    public function setContinent(\Pablo\PeopleBundle\Entity\Pays $continent = null)
    {
        $this->continent = $continent;
    
        return $this;
    }

    /**
     * Get continent
     *
     * @return \Pablo\PeopleBundle\Entity\Pays 
     */
    public function getContinent()
    {
        return $this->continent;
    }
}