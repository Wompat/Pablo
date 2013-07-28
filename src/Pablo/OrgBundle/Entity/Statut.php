<?php

namespace Pablo\OrgBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Statut
 * @package Pablo\OrgBundle\Entity
 *
 * @ORM\Table(name="statut")
 * @ORM\Entity()
 */
class Statut
{
    /**
     * @var string
     *
     * @ORM\Column(name="codestatut", type="string", length=2)
     * @ORM\Id
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * Set code
     *
     * @param string $code
     * @return Statut
     */
    public function setCode($code)
    {
        $this->code = $code;
    
        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Statut
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }
}