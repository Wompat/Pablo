<?php

namespace Pablo\OrgBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Fonction
 * @package Pablo\OrgBundle\Entity
 *
 * @ORM\Table(name="fonction")
 * @ORM\Entity()
 */
class Fonction
{
    /**
     * @var string
     *
     * @ORM\Column(name="codefonction", type="string", length=2)
     * @ORM\Id
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * Set code
     *
     * @param string $code
     * @return Fonction
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
     * @return Fonction
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