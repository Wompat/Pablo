<?php

namespace Pablo\OrganisationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Historic
 * @package Pablo\OrganisationBundle\Entity
 *
 * @ORM\Table(name="historic")
 * @ORM\Entity()
 */
class Historic
{
    /**
     * @var integer
     *
     * @ORM\Column(name="schoolyear", type="integer")
     * @ORM\Id
     */
    private $schoolYear;

    /**
     * @var boolean
     *
     * @ORM\Column(name="iscurrent", type="boolean")
     */
    private $isCurrent;

    /**
     * Set schoolYear
     *
     * @param integer $schoolYear
     * @return Historic
     */
    public function setSchoolYear($schoolYear)
    {
        $this->schoolYear = $schoolYear;
    
        return $this;
    }

    /**
     * Get schoolYear
     *
     * @return integer 
     */
    public function getSchoolYear()
    {
        return $this->schoolYear;
    }

    /**
     * Set isCurrent
     *
     * @param boolean $isCurrent
     * @return Historic
     */
    public function setIsCurrent($isCurrent)
    {
        $this->isCurrent = $isCurrent;
    
        return $this;
    }

    /**
     * Get isCurrent
     *
     * @return boolean 
     */
    public function getIsCurrent()
    {
        return $this->isCurrent;
    }
}