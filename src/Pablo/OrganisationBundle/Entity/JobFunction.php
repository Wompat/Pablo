<?php

namespace Pablo\OrganisationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class JobFunction
 * @package Pablo\OrganisationBundle\Entity
 *
 * @ORM\Table(name="jobfunction")
 * @ORM\Entity()
 */
class JobFunction
{
    /**
     * @var string
     *
     * @ORM\Column(name="codefunction", type="string", length=2)
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
     * Set codefunction
     *
     * @param string $codefunction
     * @return JobFunction
     */
    public function setCode($codefunction)
    {
        $this->code = $codefunction;
    
        return $this;
    }

    /**
     * Get codefunction
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
     * @return JobFunction
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

    public function __toString()
    {
        return $this->code;
    }
}