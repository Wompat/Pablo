<?php

namespace Pablo\PeopleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Address
 * @package Pablo\PeopleBundle\Entity
 *
 * @ORM\Table(name="address")
 * @ORM\Entity()
 */
class Address
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idaddress", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=120)
     *
     * @Assert\NotBlank()
     * @Assert\Length(min=3)
     */
    private $street;

    /**
     * @var integer
     *
     * @ORM\Column(name="number", type="smallint")
     */
    private $number;

    /**
     * @var string
     *
     * @ORM\Column(name="flat", type="string", length=8, nullable=true)
     */
    private $flat;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=120)
     *
     * @Assert\NotBlank()
     * @Assert\Length(min=4)
     */
    private $city;

    /**
     * @var \Pablo\PeopleBundle\Entity\Student
     *
     * @ORM\ManyToOne(targetEntity="Pablo\PeopleBundle\Entity\Student", inversedBy="addresses")
     * @ORM\JoinColumn(name="idperson", referencedColumnName="idperson", nullable=false)
     */
    private $person;

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
     * Set street
     *
     * @param string $street
     * @return Address
     */
    public function setStreet($street)
    {
        $this->street = $street;
    
        return $this;
    }

    /**
     * Get street
     *
     * @return string 
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set number
     *
     * @param integer $number
     * @return Address
     */
    public function setNumber($number)
    {
        $this->number = $number;
    
        return $this;
    }

    /**
     * Get number
     *
     * @return integer 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set flat
     *
     * @param string $flat
     * @return Address
     */
    public function setFlat($flat)
    {
        $this->flat = $flat;
    
        return $this;
    }

    /**
     * Get flat
     *
     * @return string 
     */
    public function getFlat()
    {
        return $this->flat;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Address
     */
    public function setCity($city)
    {
        $this->city = $city;
    
        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set person
     *
     * @param \Pablo\PeopleBundle\Entity\Student $person
     * @return Address
     */
    public function setPerson(\Pablo\PeopleBundle\Entity\Student $person)
    {
        $this->person = $person;
    
        return $this;
    }

    /**
     * Get person
     *
     * @return \Pablo\PeopleBundle\Entity\Student 
     */
    public function getPerson()
    {
        return $this->person;
    }
}