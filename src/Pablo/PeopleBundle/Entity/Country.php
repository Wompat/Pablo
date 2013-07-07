<?php

namespace Pablo\PeopleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Country
 * @package Pablo\PeopleBundle\Entity
 *
 * @ORM\Table(name="country")
 * @ORM\Entity(repositoryClass="Pablo\PeopleBundle\Entity\CountryRepository")
 */
class Country
{
    /**
     * @var string
     *
     * @ORM\Column(name="codecountry", type="string", length=2)
     * @ORM\Id
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=120)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="codefwb", type="integer")
     */
    private $codeFWB;

    /**
     * @var \Pablo\PeopleBundle\Entity\Country
     *
     * @ORM\ManyToOne(targetEntity="Pablo\PeopleBundle\Entity\Country")
     * @ORM\JoinColumn(name="codecontinent", referencedColumnName="codecountry")
     */
    private $continent;

    /**
     * Set code
     *
     * @param string $code
     * @return Country
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
     * Set name
     *
     * @param string $name
     * @return Country
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set codeFWB
     *
     * @param integer $codeFWB
     * @return Country
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
     * @param \Pablo\PeopleBundle\Entity\Country $continent
     * @return Country
     */
    public function setContinent(\Pablo\PeopleBundle\Entity\Country $continent = null)
    {
        $this->continent = $continent;
    
        return $this;
    }

    /**
     * Get continent
     *
     * @return \Pablo\PeopleBundle\Entity\Country 
     */
    public function getContinent()
    {
        return $this->continent;
    }
}