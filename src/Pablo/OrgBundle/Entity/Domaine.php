<?php

namespace Pablo\OrgBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Domaine
 * @package Pablo\OrgBundle\Entity
 *
 * @ORM\Table(name="domaine")
 * @ORM\Entity()
 */
class Domaine
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddomaine", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=60)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="nomcourt", type="string", length=20)
     */
    private $nomcourt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="actif", type="boolean")
     */
    private $actif;

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
     * Set nom
     *
     * @param string $nom
     * @return Domaine
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    
        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set nomcourt
     *
     * @param string $nomcourt
     * @return Domaine
     */
    public function setNomcourt($nomcourt)
    {
        $this->nomcourt = $nomcourt;
    
        return $this;
    }

    /**
     * Get nomcourt
     *
     * @return string 
     */
    public function getNomcourt()
    {
        return $this->nomcourt;
    }

    /**
     * Set actif
     *
     * @param boolean $actif
     * @return Domaine
     */
    public function setActif($actif)
    {
        $this->actif = $actif;
    
        return $this;
    }

    /**
     * Get actif
     *
     * @return boolean 
     */
    public function getActif()
    {
        return $this->actif;
    }
}