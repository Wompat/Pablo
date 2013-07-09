<?php

namespace Pablo\PeopleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Student
 * @package Pablo\PeopleBundle\Entity
 *
 * @ORM\Table(name="person")
 * @ORM\Entity()
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"student" = "Student", "teacher" = "Teacher"})
 */
class Student
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idperson", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=120)
     *
     * @Assert\NotBlank()
     * @Assert\Length(min=3, max=120))
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=120)
     *
     * @Assert\NotBlank()
     * @Assert\Length(min=3, max=120)
     */
    private $firstName;

    /**
     * @var \Pablo\PeopleBundle\Entity\Country
     *
     * @ORM\ManyToOne(targetEntity="Pablo\PeopleBundle\Entity\Country")
     * @ORM\JoinColumn(name="codecountry", referencedColumnName="codecountry", nullable=true)
     */
    private $nationality;

    /**
     * @var string
     *
     * @ORM\Column(name="sex", type="string", length=1)
     */
    private $sex;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateofbirth", type="date", nullable=true)
     */
    private $dateOfBirth;

    /**
     * @var string
     *
     * @ORM\Column(name="placeofbirth", type="string", length=120, nullable=true)
     *
     * @Assert\Length(min=3, max=120)
     */
    private $placeOfBirth;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Pablo\PeopleBundle\Entity\Address", mappedBy="person")
     */
    private $addresses;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Pablo\PeopleBundle\Entity\Phone", mappedBy="person")
     */
    private $phoneNumbers;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Pablo\PeopleBundle\Entity\Email", mappedBy="person")
     */
    private $emails;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Pablo\PeopleBundle\Entity\Comment", mappedBy="person")
     */
    private $comments;

    public function __construct()
    {
        $this->sex = 'F';
        $this->addresses = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->phoneNumbers = new ArrayCollection();
        $this->emails = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->lastName . ' ' . $this->firstName;
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
     * Set lastName
     *
     * @param string $lastName
     * @return Student
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    
        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return Student
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    
        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set sex
     *
     * @param string $sex
     * @return Student
     */
    public function setSex($sex)
    {
        $this->sex = $sex;
    
        return $this;
    }

    /**
     * Get sex
     *
     * @return string 
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Set dateOfBirth
     *
     * @param \DateTime $dateOfBirth
     * @return Student
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;
    
        return $this;
    }

    /**
     * Get dateOfBirth
     *
     * @return \DateTime 
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * Set placeOfBirth
     *
     * @param string $placeOfBirth
     * @return Student
     */
    public function setPlaceOfBirth($placeOfBirth)
    {
        $this->placeOfBirth = $placeOfBirth;
    
        return $this;
    }

    /**
     * Get placeOfBirth
     *
     * @return string 
     */
    public function getPlaceOfBirth()
    {
        return $this->placeOfBirth;
    }

    /**
     * Set nationality
     *
     * @param \Pablo\PeopleBundle\Entity\Country $nationality
     * @return Student
     */
    public function setNationality(\Pablo\PeopleBundle\Entity\Country $nationality = null)
    {
        $this->nationality = $nationality;
    
        return $this;
    }

    /**
     * Get nationality
     *
     * @return \Pablo\PeopleBundle\Entity\Country 
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * Add addresses
     *
     * @param \Pablo\PeopleBundle\Entity\Address $addresses
     * @return Student
     */
    public function addAddresse(\Pablo\PeopleBundle\Entity\Address $addresses)
    {
        $this->addresses[] = $addresses;
    
        return $this;
    }

    /**
     * Remove addresses
     *
     * @param \Pablo\PeopleBundle\Entity\Address $addresses
     */
    public function removeAddresse(\Pablo\PeopleBundle\Entity\Address $addresses)
    {
        $this->addresses->removeElement($addresses);
    }

    /**
     * Get addresses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * Add phoneNumbers
     *
     * @param \Pablo\PeopleBundle\Entity\Phone $phoneNumbers
     * @return Student
     */
    public function addPhoneNumber(\Pablo\PeopleBundle\Entity\Phone $phoneNumbers)
    {
        $this->phoneNumbers[] = $phoneNumbers;

        return $this;
    }

    /**
     * Remove phoneNumbers
     *
     * @param \Pablo\PeopleBundle\Entity\Phone $phoneNumbers
     */
    public function removePhoneNumber(\Pablo\PeopleBundle\Entity\Phone $phoneNumbers)
    {
        $this->phoneNumbers->removeElement($phoneNumbers);
    }

    /**
     * Get phoneNumbers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhoneNumbers()
    {
        return $this->phoneNumbers;
    }

    /**
     * Add emails
     *
     * @param \Pablo\PeopleBundle\Entity\Email $emails
     * @return Student
     */
    public function addEmail(\Pablo\PeopleBundle\Entity\Email $emails)
    {
        $this->emails[] = $emails;

        return $this;
    }

    /**
     * Remove emails
     *
     * @param \Pablo\PeopleBundle\Entity\Email $emails
     */
    public function removeEmail(\Pablo\PeopleBundle\Entity\Email $emails)
    {
        $this->emails->removeElement($emails);
    }

    /**
     * Get emails
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEmails()
    {
        return $this->emails;
    }

    /**
     * Add comments
     *
     * @param \Pablo\PeopleBundle\Entity\Comment $comments
     * @return Student
     */
    public function addComment(\Pablo\PeopleBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;
    
        return $this;
    }

    /**
     * Remove comments
     *
     * @param \Pablo\PeopleBundle\Entity\Comment $comments
     */
    public function removeComment(\Pablo\PeopleBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }
}