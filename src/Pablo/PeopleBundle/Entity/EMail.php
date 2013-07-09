<?php

namespace Pablo\PeopleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Email
 * @package Pablo\PeopleBundle\Entity
 *
 * @ORM\Table(name="email")
 * @ORM\Entity()
 */
class Email
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idemail", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=60)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="info", type="string", length=24, nullable=true)
     */
    private $info;

    /**
     * @var \Pablo\PeopleBundle\Entity\Student
     *
     * @ORM\ManyToOne(targetEntity="Pablo\PeopleBundle\Entity\Student", inversedBy="emails")
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
     * Set address
     *
     * @param string $address
     * @return Email
     */
    public function setAddress($address)
    {
        $this->address = $address;
    
        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set info
     *
     * @param string $info
     * @return Email
     */
    public function setInfo($info)
    {
        $this->info = $info;
    
        return $this;
    }

    /**
     * Get info
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
     * @return Email
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