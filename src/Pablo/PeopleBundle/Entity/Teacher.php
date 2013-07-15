<?php

namespace Pablo\PeopleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Teacher
 * @package Pablo\PeopleBundle\Entity
 *
 * @ORM\Entity(repositoryClass="Pablo\PeopleBundle\Entity\TeacherRepository")
 */
class Teacher extends Student
{
    /**
     * @var string
     *
     * @ORM\Column(name="matricule", type="string", length=11, nullable=true)
     *
     * @Assert\Length(min=7)
     */
    private $matricule;

    /**
     * @var \Pablo\UserBundle\Entity\User
     *
     * @ORM\OneToOne(targetEntity="Pablo\UserBundle\Entity\User", mappedBy="teacher")
     */
    private $user;

    /**
     * Set matricule
     *
     * @param string $matricule
     * @return Teacher
     */
    public function setMatricule($matricule)
    {
        $this->matricule = $matricule;
    
        return $this;
    }

    /**
     * Get matricule
     *
     * @return string 
     */
    public function getMatricule()
    {
        return $this->matricule;
    }

    /**
     * Set user
     *
     * @param \Pablo\UserBundle\Entity\User $user
     * @return Teacher
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
}