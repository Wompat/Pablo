<?php

namespace Pablo\PeopleBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Employe
 * @package Pablo\PeopleBundle\Entity
 *
 * @ORM\Entity(repositoryClass="Pablo\PeopleBundle\Entity\EmployeRepository")
 */
class Employe extends Personne
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
     * @ORM\OneToOne(targetEntity="Pablo\UserBundle\Entity\User", mappedBy="employe")
     */
    private $user;

    public function __construct()
    {
        parent::__construct();
        $this->attributions = new ArrayCollection();
    }

    /**
     * Set matricule
     *
     * @param string $matricule
     * @return Employe
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
     * @return Employe
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