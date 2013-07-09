<?php

namespace Pablo\PeopleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class PhoneNumber
 * @package Pablo\PeopleBundle\Entity
 *
 * @ORM\Table(name="phonenumber")
 * @ORM\Entity()
 */
class Phone
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idphonenumber", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="number", type="string", length=18)
     *
     * @Assert\NotBlank
     * @Assert\Length(min=9)
     */
    private $number;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ismobile", type="boolean")
     */
    private $isMobile;

    /**
     * @var string
     *
     * @ORM\Column(name="info", type="string", length=24, nullable=true)
     *
     * @Assert\Length(min=3)
     */
    private $info;

    /**
     * @var \Pablo\PeopleBundle\Entity\Student
     *
     * @ORM\ManyToOne(targetEntity="Pablo\PeopleBundle\Entity\Student", inversedBy="phoneNumbers")
     * @ORM\JoinColumn(name="idperson", referencedColumnName="idperson", nullable=false)
     */
    private $person;

    public function __construct()
    {
        $this->isMobile = false;
    }

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
     * Set number
     *
     * @param string $number
     * @return Phone
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set isMobile
     *
     * @param boolean $isMobile
     * @return Phone
     */
    public function setIsMobile($isMobile)
    {
        $this->isMobile = $isMobile;
    
        return $this;
    }

    /**
     * Get isMobile
     *
     * @return boolean 
     */
    public function getIsMobile()
    {
        return $this->isMobile;
    }

    /**
     * Set comment
     *
     * @param string $info
     * @return Phone
     */
    public function setInfo($info)
    {
        $this->info = $info;
    
        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * Set person
     *
     * @param \Pablo\PeopleBundle\Entity\Student $person
     * @return Phone
     */
    public function setPerson(\Pablo\PeopleBundle\Entity\Student $person = null)
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