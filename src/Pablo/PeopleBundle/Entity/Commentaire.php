<?php

/**
 * Ce fichier est une partie de l'application Pablo.
 *
 * @author Thomas Decraux <thomasdecraux@gmail.com>
 * @version <0.1.0>
 */

namespace Pablo\PeopleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Commentaire
 * @package Pablo\PeopleBundle\Entity
 *
 * @ORM\Table(name="commentaire")
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class Commentaire
{
    /**
     * Clé primaire auto-incrémentée gérée par Doctrine
     * @var integer
     *
     * @ORM\Column(name="idcommentaire", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Contenu
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     *
     * @Assert\NotBlank()
     * @Assert\Length(min=4)
     */
    private $contenu;

    /**
     * Date de création
     * @var \DateTime
     *
     * @ORM\Column(name="datecreation", type="datetime")
     */
    private $datecreation;

    /**
     * Date de la dernière modification
     * @var \DateTime
     *
     * @ORM\Column(name="datemodification", type="datetime")
     */
    private $datemodification;

    /**
     * Personne
     * @var \Pablo\PeopleBundle\Entity\Personne
     *
     * @ORM\ManyToOne(targetEntity="Pablo\PeopleBundle\Entity\Personne", inversedBy="commentaires")
     * @ORM\JoinColumn(name="idpersonne", referencedColumnName="idpersonne", nullable=false)
     */
    private $personne;

    /**
     * Utilisateur
     * @var \Pablo\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Pablo\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="iduser", referencedColumnName="iduser", nullable=false)
     */
    private $user;

    /**
     * Constructeur : crée les instances de la classe ArrayCollection.
     */
    public function __construct()
    {
        $this->datecreation = new \DateTime();
        $this->datemodification = new \DateTime();
    }

    /**
     * Méthode appelée par Doctrine avant de mettre à jour l'entité
     * Enregistre la date et l'heure courantes dans le champ datemodification
     * @ORM\PreUpdate
     */
    public function setModification() {
        $this->datemodification = new \DateTime();
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
     * Set contenu
     *
     * @param string $contenu
     * @return Commentaire
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    
        return $this;
    }

    /**
     * Get contenu
     *
     * @return string 
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set datecreation
     *
     * @param \DateTime $datecreation
     * @return Commentaire
     */
    public function setDatecreation($datecreation)
    {
        $this->datecreation = $datecreation;
    
        return $this;
    }

    /**
     * Get datecreation
     *
     * @return \DateTime 
     */
    public function getDatecreation()
    {
        return $this->datecreation;
    }

    /**
     * Set datemodification
     *
     * @param \DateTime $datemodification
     * @return Commentaire
     */
    public function setDatemodification($datemodification)
    {
        $this->datemodification = $datemodification;
    
        return $this;
    }

    /**
     * Get datemodification
     *
     * @return \DateTime 
     */
    public function getDatemodification()
    {
        return $this->datemodification;
    }

    /**
     * Set personne
     *
     * @param \Pablo\PeopleBundle\Entity\Personne $personne
     * @return Commentaire
     */
    public function setPersonne(\Pablo\PeopleBundle\Entity\Personne $personne = null)
    {
        $this->personne = $personne;
    
        return $this;
    }

    /**
     * Get personne
     *
     * @return \Pablo\PeopleBundle\Entity\Personne 
     */
    public function getPersonne()
    {
        return $this->personne;
    }

    /**
     * Set user
     *
     * @param \Pablo\UserBundle\Entity\User $user
     * @return Commentaire
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