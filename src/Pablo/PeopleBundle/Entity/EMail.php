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
 * Class Email
 * @package Pablo\PeopleBundle\Entity
 *
 * @ORM\Table(name="email")
 * @ORM\Entity()
 */
class Email
{
    /**
     * Clé primaire auto-incrémentée gérée par Doctrine
     * @var integer
     *
     * @ORM\Column(name="idemail", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Adresse électronique
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=60)
     *
     * @Assert\Email(checkMX=true, checkHost=true)
     */
    private $adresse;

    /**
     * Infos complémentaires
     * @var string
     *
     * @ORM\Column(name="info", type="string", length=24, nullable=true)
     */
    private $info;

    /**
     * Personne
     * @var \Pablo\PeopleBundle\Entity\Personne
     *
     * @ORM\ManyToOne(targetEntity="Pablo\PeopleBundle\Entity\Personne", inversedBy="emails")
     * @ORM\JoinColumn(name="idpersonne", referencedColumnName="idpersonne", nullable=false)
     */
    private $personne;

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
     * Set adresse
     *
     * @param string $adresse
     * @return Email
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    
        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse()
    {
        return $this->adresse;
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
     * Set personne
     *
     * @param \Pablo\PeopleBundle\Entity\Personne $personne
     * @return Email
     */
    public function setPersonne(\Pablo\PeopleBundle\Entity\Personne $personne)
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
}