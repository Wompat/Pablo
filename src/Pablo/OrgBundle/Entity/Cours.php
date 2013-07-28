<?php

namespace Pablo\OrgBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Cours
 * @package Pablo\OrgBundle\Entity
 *
 * @ORM\Table(name="cours")
 * @ORM\Entity(repositoryClass="Pablo\OrgBundle\Entity\CoursRepository")
 */
class Cours
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcours", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=60)
     */
    private $libelle;

    /**
     * @var boolean
     *
     * @ORM\Column(name="base", type="boolean")
     */
    private $base;

    /**
     * @var \Pablo\OrgBundle\Entity\Cours
     *
     * @ORM\ManyToOne(targetEntity="Pablo\OrgBundle\Entity\Cours")
     * @ORM\JoinColumn(name="idintitule", referencedColumnName="idcours")
     */
    private $intitule;

    /**
     * @var \Pablo\OrgBundle\Entity\Domaine
     *
     * @ORM\ManyToOne(targetEntity="Pablo\OrgBundle\Entity\Domaine")
     * @ORM\JoinColumn(name="iddomaine", referencedColumnName="iddomaine", nullable=false)
     */
    private $domaine;

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
     * Set libelle
     *
     * @param string $libelle
     * @return Cours
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    
        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set base
     *
     * @param boolean $base
     * @return Cours
     */
    public function setBase($base)
    {
        $this->base = $base;
    
        return $this;
    }

    /**
     * Get base
     *
     * @return boolean 
     */
    public function getBase()
    {
        return $this->base;
    }

    /**
     * Set intitule
     *
     * @param \Pablo\OrgBundle\Entity\Cours $intitule
     * @return Cours
     */
    public function setIntitule(\Pablo\OrgBundle\Entity\Cours $intitule = null)
    {
        $this->intitule = $intitule;
    
        return $this;
    }

    /**
     * Get intitule
     *
     * @return \Pablo\OrgBundle\Entity\Cours 
     */
    public function getIntitule()
    {
        return $this->intitule;
    }

    /**
     * Set domaine
     *
     * @param \Pablo\OrgBundle\Entity\Domaine $domaine
     * @return Cours
     */
    public function setDomaine(\Pablo\OrgBundle\Entity\Domaine $domaine)
    {
        $this->domaine = $domaine;
    
        return $this;
    }

    /**
     * Get domaine
     *
     * @return \Pablo\OrgBundle\Entity\Domaine 
     */
    public function getDomaine()
    {
        return $this->domaine;
    }
}