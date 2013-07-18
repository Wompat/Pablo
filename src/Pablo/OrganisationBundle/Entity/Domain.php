<?php

namespace Pablo\OrganisationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Domain
 * @package Pablo\OrganisationBundle\Entity
 *
 * @ORM\Table(name="domain")
 * @ORM\Entity()
 */
class Domain
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddomain", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="longname", type="string", length=60)
     */
    private $longName;

    /**
     * @var string
     *
     * @ORM\Column(name="shortname", type="string", length=20)
     */
    private $shortName;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;

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
     * Set longName
     *
     * @param string $longName
     * @return Domain
     */
    public function setLongName($longName)
    {
        $this->longName = $longName;
    
        return $this;
    }

    /**
     * Get longName
     *
     * @return string 
     */
    public function getLongName()
    {
        return $this->longName;
    }

    /**
     * Set shortName
     *
     * @param string $shortName
     * @return Domain
     */
    public function setShortName($shortName)
    {
        $this->shortName = $shortName;
    
        return $this;
    }

    /**
     * Get shortName
     *
     * @return string 
     */
    public function getShortName()
    {
        return $this->shortName;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return Domain
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    
        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }
}