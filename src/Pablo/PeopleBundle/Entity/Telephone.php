<?php

namespace Pablo\PeopleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class PhoneNumber
 * @package Pablo\PeopleBundle\Entity
 *
 * @ORM\Table(name="telephone")
 * @ORM\Entity()
 */
class Telephone
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idtelephone", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=18)
     *
     * @Assert\NotBlank
     * @Assert\Length(min=9)
     */
    private $numero;

    /**
     * @var boolean
     *
     * @ORM\Column(name="mobile", type="boolean")
     */
    private $mobile;

    /**
     * @var string
     *
     * @ORM\Column(name="info", type="string", length=24, nullable=true)
     *
     * @Assert\Length(min=3)
     */
    private $info;

    /**
     * @var \Pablo\PeopleBundle\Entity\Personne
     *
     * @ORM\ManyToOne(targetEntity="Pablo\PeopleBundle\Entity\Personne", inversedBy="telephones")
     * @ORM\JoinColumn(name="idpersonne", referencedColumnName="idpersonne", nullable=false)
     */
    private $personne;

    public function __construct()
    {
        $this->isMobile = false;
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
     * Set numero
     *
     * @param string $numero
     * @return Telephone
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    
        return $this;
    }

    /**
     * Get numero
     *
     * @return string 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set mobile
     *
     * @param boolean $mobile
     * @return Telephone
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
    
        return $this;
    }

    /**
     * Get mobile
     *
     * @return boolean 
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set info
     *
     * @param string $info
     * @return Telephone
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
     * @return Telephone
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