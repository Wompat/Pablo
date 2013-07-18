<?php

namespace Pablo\PeopleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Comment
 * @package Pablo\PeopleBundle\Entity
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class Comment
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcomment", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     *
     * @Assert\NotBlank()
     * @Assert\Length(min=4)
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime")
     */
    private $updated;

    /**
     * @var \Pablo\PeopleBundle\Entity\Student
     *
     * @ORM\ManyToOne(targetEntity="Pablo\PeopleBundle\Entity\Student", inversedBy="comments")
     * @ORM\JoinColumn(name="idperson", referencedColumnName="idperson")
     */
    private $person;

    /**
     * @var \Pablo\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Pablo\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="iduser", referencedColumnName="iduser")
     */
    private $user;

    public function __construct()
    {
        $this->created = new \DateTime();
        $this->updated = new \DateTime();
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
     * Set content
     *
     * @param string $content
     * @return Comment
     */
    public function setContent($content)
    {
        $this->content = $content;
    
        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Comment
     */
    public function setCreated($created)
    {
        $this->created = $created;
    
        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Comment
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    
        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set person
     *
     * @param \Pablo\PeopleBundle\Entity\Student $person
     * @return Comment
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

    /**
     * Set user
     *
     * @param \Pablo\UserBundle\Entity\User $user
     * @return Comment
     */
    public function setUser(\Pablo\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Pablo\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedValue() {
        $this->updated = new \DateTime();
    }
}