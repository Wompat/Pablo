<?php

/**
 * Ce fichier est une partie de l'application Pablo.
 *
 * @author Thomas Decraux <thomasdecraux@gmail.com>
 * @version <0.1.0>
 */

namespace Pablo\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\Role\Role;

/**
 * Class Group
 *
 * @ORM\Table(name="pgroup")
 * @ORM\Entity()
 *
 * @UniqueEntity("name")
 * @UniqueEntity("role")
 */
class Group extends Role
{
    /**
     * Clé primaire auto-incrémentée gérée par Doctrine
     *
     * @ORM\Column(name="idgroup", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Nom du groupe
     *
     * @ORM\Column(name="name", type="string", length=30, unique=true)
     */
    private $name;

    /**
     * Rôle associé au groupe
     *
     * @ORM\Column(name="role", type="string", length=20, unique=true)
     */
    private $role;

    /**
     * Utilisateurs appartenant au groupe
     *
     * @ORM\ManyToMany(targetEntity="User", mappedBy="groups")
     */
    private $users;

    /**
     * Constructeur : crée une instance de la classe ArrayCollection.
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Group
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
     * Set role
     *
     * @param string $role
     * @return Group
     */
    public function setRole($role)
    {
        $this->role = $role;
    
        return $this;
    }

    /**
     * Get role
     *
     * @return string 
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Add users
     *
     * @param \Pablo\UserBundle\Entity\User $users
     * @return Group
     */
    public function addUser(User $users)
    {
        $this->users[] = $users;
    
        return $this;
    }

    /**
     * Remove users
     *
     * @param \Pablo\UserBundle\Entity\User $users
     */
    public function removeUser(User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }

    public function __toString()
    {
        return $this->name;
    }
}