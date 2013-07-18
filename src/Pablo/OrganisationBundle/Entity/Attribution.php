<?php

namespace Pablo\OrganisationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Attribution
 * @package Pablo\OrganisationBundle\Entity
 *
 * @ORM\Table(name="attribution")
 * @ORM\Entity
 */
class Attribution
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idattribution", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ayear", type="date")
     */
    private $year;

    /**
     * @var \Pablo\PeopleBundle\Entity\Teacher
     *
     * @ORM\ManyToOne(targetEntity="Pablo\PeopleBundle\Entity\Teacher")
     * @ORM\JoinColumn(name="idperson", referencedColumnName="idperson", nullable=false)
     */
    private $teacher;

    /**
     * @var \Pablo\OrganisationBundle\Entity\JobFunction
     *
     * @ORM\ManyToOne(targetEntity="Pablo\OrganisationBundle\Entity\JobFunction")
     * @ORM\JoinColumn(name="codefunction", referencedColumnName="codefunction", nullable=false)
     */
    private $jobFunction;

    /**
     * @var \Pablo\OrganisationBundle\Entity\Status
     *
     * @ORM\ManyToOne(targetEntity="Pablo\OrganisationBundle\Entity\Status")
     * @ORM\JoinColumn(name="codestatus", referencedColumnName="codestatus", nullable=false)
     */
    private $status;


    /**
     * @var \Pablo\OrganisationBundle\Entity\Course
     *
     * @ORM\ManyToOne(targetEntity="Pablo\OrganisationBundle\Entity\Course")
     * @ORM\JoinColumn(name="idcourse", referencedColumnName="idcourse", nullable=true)
     */
    private $course;

    /**
     * @var \Pablo\OrganisationBundle\Entity\Course
     *
     * @ORM\ManyToOne(targetEntity="Pablo\OrganisationBundle\Entity\Course")
     * @ORM\JoinColumn(name="idspecialty", referencedColumnName="idcourse", nullable=true)
     */
    private $specialty;

    /**
     * @var integer
     *
     * @ORM\Column(name="periods", type="smallint")
     */
    private $periods;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startdate", type="date")
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="enddate", type="date", nullable=true)
     */
    private $endDate;

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
     * Set year
     *
     * @param \DateTime $year
     * @return Attribution
     */
    public function setYear($year)
    {
        $this->year = $year;
    
        return $this;
    }

    /**
     * Get year
     *
     * @return \DateTime 
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set periods
     *
     * @param integer $periods
     * @return Attribution
     */
    public function setPeriods($periods)
    {
        $this->periods = $periods;
    
        return $this;
    }

    /**
     * Get periods
     *
     * @return integer 
     */
    public function getPeriods()
    {
        return $this->periods;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return Attribution
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    
        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     * @return Attribution
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    
        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime 
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set teacher
     *
     * @param \Pablo\PeopleBundle\Entity\Teacher $teacher
     * @return Attribution
     */
    public function setTeacher(\Pablo\PeopleBundle\Entity\Teacher $teacher)
    {
        $this->teacher = $teacher;
    
        return $this;
    }

    /**
     * Get teacher
     *
     * @return \Pablo\PeopleBundle\Entity\Teacher 
     */
    public function getTeacher()
    {
        return $this->teacher;
    }

    /**
     * Set jobFunction
     *
     * @param \Pablo\OrganisationBundle\Entity\JobFunction $jobFunction
     * @return Attribution
     */
    public function setJobFunction(\Pablo\OrganisationBundle\Entity\JobFunction $jobFunction)
    {
        $this->jobFunction = $jobFunction;
    
        return $this;
    }

    /**
     * Get jobFunction
     *
     * @return \Pablo\OrganisationBundle\Entity\JobFunction 
     */
    public function getJobFunction()
    {
        return $this->jobFunction;
    }

    /**
     * Set status
     *
     * @param \Pablo\OrganisationBundle\Entity\Status $status
     * @return Attribution
     */
    public function setStatus(\Pablo\OrganisationBundle\Entity\Status $status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return \Pablo\OrganisationBundle\Entity\Status 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set course
     *
     * @param \Pablo\OrganisationBundle\Entity\Course $course
     * @return Attribution
     */
    public function setCourse(\Pablo\OrganisationBundle\Entity\Course $course = null)
    {
        $this->course = $course;
    
        return $this;
    }

    /**
     * Get course
     *
     * @return \Pablo\OrganisationBundle\Entity\Course 
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * Set specialty
     *
     * @param \Pablo\OrganisationBundle\Entity\Course $specialty
     * @return Attribution
     */
    public function setSpecialty(\Pablo\OrganisationBundle\Entity\Course $specialty = null)
    {
        $this->specialty = $specialty;
    
        return $this;
    }

    /**
     * Get specialty
     *
     * @return \Pablo\OrganisationBundle\Entity\Course 
     */
    public function getSpecialty()
    {
        return $this->specialty;
    }
}