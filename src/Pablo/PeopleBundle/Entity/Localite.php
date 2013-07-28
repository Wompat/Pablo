<?php

namespace Pablo\PeopleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Localite
 * @package Pablo\PeopleBundle\Entity
 *
 * @ORM\Table(name="localite")
 * @ORM\Entity(repositoryClass="Pablo\PeopleBundle\Entity\LocaliteRepository")
 */
class Localite
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idlocalite", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=80)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="codepostal", type="string", length=6)
     */
    private $codepostal;

    /**
     * @var string
     *
     * @ORM\Column(name="province", type="string", length=80, nullable=true)
     */
    private $province;

    /**
     * @var \Pablo\PeopleBundle\Entity\Pays
     *
     * @ORM\ManyToOne(targetEntity="Pablo\PeopleBundle\Entity\Pays")
     * @ORM\JoinColumn(name="codepays", referencedColumnName="codepays", nullable=true)
     */
    private $pays;

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
     * @return Localite
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
     * Set codepostal
     *
     * @param string $codepostal
     * @return Localite
     */
    public function setCodepostal($codepostal)
    {
        $this->codepostal = $codepostal;
    
        return $this;
    }

    /**
     * Get codepostal
     *
     * @return string 
     */
    public function getCodepostal()
    {
        return $this->codepostal;
    }

    /**
     * Set province
     *
     * @param string $province
     * @return Localite
     */
    public function setProvince($province)
    {
        $this->province = $province;
    
        return $this;
    }

    /**
     * Get province
     *
     * @return string 
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * Set pays
     *
     * @param \Pablo\PeopleBundle\Entity\Pays $pays
     * @return Localite
     */
    public function setPays(\Pablo\PeopleBundle\Entity\Pays $pays = null)
    {
        $this->pays = $pays;
    
        return $this;
    }

    /**
     * Get pays
     *
     * @return \Pablo\PeopleBundle\Entity\Pays 
     */
    public function getPays()
    {
        return $this->pays;
    }
}