<?php

namespace Pablo\PeopleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class City
 * @package Pablo\PeopleBundle\Entity
 *
 * @ORM\Table(name="city")
 * @ORM\Entity(repositoryClass="Pablo\PeopleBundle\Entity\CityRepository")
 */
class City
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcity", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=80)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="postalcode", type="string", length=6)
     */
    private $postalCode;

    /**
     * @var string
     *
     * @ORM\Column(name="province", type="string", length=80, nullable=true)
     */
    private $province;

    /**
     * @var \Pablo\PeopleBundle\Entity\Country
     *
     * @ORM\ManyToOne(targetEntity="Pablo\PeopleBundle\Entity\Country")
     * @ORM\JoinColumn(name="codecountry", referencedColumnName="codecountry", nullable=true)
     */
    private $country;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return City
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
     * Set postalCode
     *
     * @param string $postalCode
     * @return City
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
    
        return $this;
    }

    /**
     * Get postalCode
     *
     * @return string 
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set province
     *
     * @param string $province
     * @return City
     */
    public function setProvince($province)
    {
        $this->province = $province;
    
        return $this;
    }

    /**
     * Get province
     *
     * @return string 
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * Set country
     *
     * @param \Pablo\PeopleBundle\Entity\Country $country
     * @return City
     */
    public function setCountry(\Pablo\PeopleBundle\Entity\Country $country = null)
    {
        $this->country = $country;
    
        return $this;
    }

    /**
     * Get country
     *
     * @return \Pablo\PeopleBundle\Entity\Country 
     */
    public function getCountry()
    {
        return $this->country;
    }
}