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
class PhoneNumber
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
     * @ORM\Column(name="phonenumber", type="string", length=18)
     *
     * @Assert\NotBlank
     * @Assert\Length(min=9)
     */
    private $phoneNumber;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ismobile", type="boolean")
     */
    private $isMobile;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=18, nullable=false)
     */
    private $comment;

    /**
     * @var \Pablo\PeopleBundle\Entity\Student
     *
     * @ORM\ManyToOne(targetEntity="Pablo\PeopleBundle\Entity\Student", inversedBy="phoneNumbers", cascade={"all"}, fetch="EAGER")
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
     * Set phoneNumber
     *
     * @param string $phoneNumber
     * @return PhoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    
        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string 
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set isMobile
     *
     * @param boolean $isMobile
     * @return PhoneNumber
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
     * @param string $comment
     * @return PhoneNumber
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    
        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set person
     *
     * @param \Pablo\PeopleBundle\Entity\Student $person
     * @return PhoneNumber
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