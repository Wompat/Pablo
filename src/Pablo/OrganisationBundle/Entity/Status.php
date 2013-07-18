<?php

namespace Pablo\OrganisationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Status
 * @package Pablo\OrganisationBundle\Entity
 *
 * @ORM\Table(name="status")
 * @ORM\Entity()
 */
class Status
{
    /**
     * @var string
     *
     * @ORM\Column(name="codestatus", type="string", length=2)
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
     * @return Status
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
     * @return Status
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