<?php

namespace Pablo\OrganisationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Course
 * @package Pablo\OrganisationBundle\Entity
 *
 * @ORM\Table(name="course")
 * @ORM\Entity(repositoryClass="Pablo\OrganisationBundle\Entity\CourseRepository")
 */
class Course
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcourse", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=60)
     */
    private $title;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isbase", type="boolean")
     */
    private $isBase;

    /**
     * @var \Pablo\OrganisationBundle\Entity\Course
     *
     * @ORM\ManyToOne(targetEntity="Pablo\OrganisationBundle\Entity\Course")
     * @ORM\JoinColumn(name="idparent", referencedColumnName="idcourse")
     */
    private $parent;

    /**
     * @var \Pablo\OrganisationBundle\Entity\Domain
     *
     * @ORM\ManyToOne(targetEntity="Pablo\OrganisationBundle\Entity\Domain")
     * @ORM\JoinColumn(name="iddomain", referencedColumnName="iddomain", nullable=false)
     */
    private $domain;

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
     * Set title
     *
     * @param string $title
     * @return Course
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set isBase
     *
     * @param boolean $isBase
     * @return Course
     */
    public function setIsBase($isBase)
    {
        $this->isBase = $isBase;
    
        return $this;
    }

    /**
     * Get isBase
     *
     * @return boolean 
     */
    public function getIsBase()
    {
        return $this->isBase;
    }

    /**
     * Set parent
     *
     * @param \Pablo\OrganisationBundle\Entity\Course $parent
     * @return Course
     */
    public function setParent(\Pablo\OrganisationBundle\Entity\Course $parent = null)
    {
        $this->parent = $parent;
    
        return $this;
    }

    /**
     * Get parent
     *
     * @return \Pablo\OrganisationBundle\Entity\Course 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set domain
     *
     * @param \Pablo\OrganisationBundle\Entity\Domain $domain
     * @return Course
     */
    public function setDomain(\Pablo\OrganisationBundle\Entity\Domain $domain = null)
    {
        $this->domain = $domain;
    
        return $this;
    }

    /**
     * Get domain
     *
     * @return \Pablo\OrganisationBundle\Entity\Domain 
     */
    public function getDomain()
    {
        return $this->domain;
    }

    public function __toString()
{
return $this->title;
}
}