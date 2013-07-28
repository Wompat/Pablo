<?php

namespace Pablo\PeopleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Adresse
 * @package Pablo\PeopleBundle\Entity
 *
 * @ORM\Table(name="adresse")
 * @ORM\Entity()
 */
class Adresse
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idadresse", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="voie", type="string", length=120)
     *
     * @Assert\NotBlank()
     * @Assert\Length(min=3)
     */
    private $voie;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero", type="smallint")
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="boite", type="string", length=8, nullable=true)
     */
    private $boite;

    /**
     * @var string
     *
     * @ORM\Column(name="localite", type="string", length=120)
     *
     * @Assert\NotBlank()
     * @Assert\Length(min=4)
     */
    private $localite;

    /**
     * @var \Pablo\PeopleBundle\Entity\Personne
     *
     * @ORM\ManyToOne(targetEntity="Pablo\PeopleBundle\Entity\Personne", inversedBy="adresses")
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
     * Set voie
     *
     * @param string $voie
     * @return Adresse
     */
    public function setVoie($voie)
    {
        $this->voie = $voie;
    
        return $this;
    }

    /**
     * Get voie
     *
     * @return string 
     */
    public function getVoie()
    {
        return $this->voie;
    }

    /**
     * Set numero
     *
     * @param integer $numero
     * @return Adresse
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    
        return $this;
    }

    /**
     * Get numero
     *
     * @return integer 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set boite
     *
     * @param string $boite
     * @return Adresse
     */
    public function setBoite($boite)
    {
        $this->boite = $boite;
    
        return $this;
    }

    /**
     * Get boite
     *
     * @return string 
     */
    public function getBoite()
    {
        return $this->boite;
    }

    /**
     * Set localite
     *
     * @param string $localite
     * @return Adresse
     */
    public function setLocalite($localite)
    {
        $this->localite = $localite;
    
        return $this;
    }

    /**
     * Get localite
     *
     * @return string 
     */
    public function getLocalite()
    {
        return $this->localite;
    }

    /**
     * Set personne
     *
     * @param \Pablo\PeopleBundle\Entity\Personne $personne
     * @return Adresse
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