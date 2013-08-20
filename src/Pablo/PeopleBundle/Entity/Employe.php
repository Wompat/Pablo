<?php

/**
 * Ce fichier est une partie de l'application Pablo.
 *
 * @author Thomas Decraux <thomasdecraux@gmail.com>
 * @version <0.1.0>
 */

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
     * Numéro matricule de l'employé
     * @var string
     *
     * @ORM\Column(name="matricule", type="string", length=11, nullable=true)
     *
     * @Assert\Length(min=7)
     */
    private $matricule;

    /**
     * Utilisateur lié à l'employé
     * @var \Pablo\UserBundle\Entity\User
     *
     * @ORM\OneToOne(targetEntity="Pablo\UserBundle\Entity\User", mappedBy="employe")
     */
    private $user;

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