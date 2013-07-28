<?php

namespace Pablo\OrgBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Annee
 * @package Pablo\OrgBundle\Entity
 *
 * @ORM\Table(name="annee")
 * @ORM\Entity()
 */
class Annee
{
    /**
     * @var integer
     *
     * @ORM\Column(name="valeur", type="integer")
     * @ORM\Id
     */
    private $valeur;

    /**
     * @var boolean
     *
     * @ORM\Column(name="courante", type="boolean")
     */
    private $courante;

    /**
     * Set valeur
     *
     * @param integer $valeur
     * @return Annee
     */
    public function setValeur($valeur)
    {
        $this->valeur = $valeur;
    
        return $this;
    }

    /**
     * Get valeur
     *
     * @return integer 
     */
    public function getValeur()
    {
        return $this->valeur;
    }

    /**
     * Set courante
     *
     * @param boolean $courante
     * @return Annee
     */
    public function setCourante($courante)
    {
        $this->courante = $courante;
    
        return $this;
    }

    /**
     * Get courante
     *
     * @return boolean 
     */
    public function getCourante()
    {
        return $this->courante;
    }
}