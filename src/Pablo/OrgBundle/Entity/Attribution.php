<?php

namespace Pablo\OrgBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Attribution
 * @package Pablo\OrgBundle\Entity
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
     * @var integer
     *
     * @ORM\Column(name="annee", type="integer")
     */
    private $annee;

    /**
     * @var \Pablo\PeopleBundle\Entity\Employe
     *
     * @ORM\ManyToOne(targetEntity="Pablo\PeopleBundle\Entity\Employe", inversedBy="attributions")
     * @ORM\JoinColumn(name="idpersonne", referencedColumnName="idpersonne", nullable=false)
     */
    private $employe;

    /**
     * @var \Pablo\OrgBundle\Entity\Fonction
     *
     * @ORM\ManyToOne(targetEntity="Pablo\OrgBundle\Entity\Fonction")
     * @ORM\JoinColumn(name="codefonction", referencedColumnName="codefonction", nullable=false)
     */
    private $codefonction;

    /**
     * @var \Pablo\OrgBundle\Entity\Statut
     *
     * @ORM\ManyToOne(targetEntity="Pablo\OrgBundle\Entity\Statut")
     * @ORM\JoinColumn(name="codestatut", referencedColumnName="codestatut", nullable=false)
     */
    private $statut;


    /**
     * @var \Pablo\OrgBundle\Entity\Cours
     *
     * @ORM\ManyToOne(targetEntity="Pablo\OrgBundle\Entity\Cours")
     * @ORM\JoinColumn(name="idintitule", referencedColumnName="idcours", nullable=true)
     */
    private $intitule;

    /**
     * @var \Pablo\OrgBundle\Entity\Cours
     *
     * @ORM\ManyToOne(targetEntity="Pablo\OrgBundle\Entity\Cours")
     * @ORM\JoinColumn(name="idspecialite", referencedColumnName="idcours", nullable=true)
     */
    private $specialite;

    /**
     * @var integer
     *
     * @ORM\Column(name="periodes", type="smallint")
     */
    private $periodes;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datedebut", type="date")
     */
    private $datedebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datefin", type="date", nullable=true)
     */
    private $datefin;

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
     * Set annee
     *
     * @param integer $annee
     * @return Attribution
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;
    
        return $this;
    }

    /**
     * Get annee
     *
     * @return integer 
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * Set periodes
     *
     * @param integer $periodes
     * @return Attribution
     */
    public function setPeriodes($periodes)
    {
        $this->periodes = $periodes;
    
        return $this;
    }

    /**
     * Get periodes
     *
     * @return integer 
     */
    public function getPeriodes()
    {
        return $this->periodes;
    }

    /**
     * Set datedebut
     *
     * @param \DateTime $datedebut
     * @return Attribution
     */
    public function setDatedebut($datedebut)
    {
        $this->datedebut = $datedebut;
    
        return $this;
    }

    /**
     * Get datedebut
     *
     * @return \DateTime 
     */
    public function getDatedebut()
    {
        return $this->datedebut;
    }

    /**
     * Set datefin
     *
     * @param \DateTime $datefin
     * @return Attribution
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;
    
        return $this;
    }

    /**
     * Get datefin
     *
     * @return \DateTime 
     */
    public function getDatefin()
    {
        return $this->datefin;
    }

    /**
     * Set employe
     *
     * @param \Pablo\PeopleBundle\Entity\Employe $employe
     * @return Attribution
     */
    public function setEmploye(\Pablo\PeopleBundle\Entity\Employe $employe)
    {
        $this->employe = $employe;
    
        return $this;
    }

    /**
     * Get employe
     *
     * @return \Pablo\PeopleBundle\Entity\Employe 
     */
    public function getEmploye()
    {
        return $this->employe;
    }

    /**
     * Set codefonction
     *
     * @param \Pablo\OrgBundle\Entity\Fonction $codefonction
     * @return Attribution
     */
    public function setCodefonction(\Pablo\OrgBundle\Entity\Fonction $codefonction)
    {
        $this->codefonction = $codefonction;
    
        return $this;
    }

    /**
     * Get codefonction
     *
     * @return \Pablo\OrgBundle\Entity\Fonction 
     */
    public function getCodefonction()
    {
        return $this->codefonction;
    }

    /**
     * Set statut
     *
     * @param \Pablo\OrgBundle\Entity\Statut $statut
     * @return Attribution
     */
    public function setStatut(\Pablo\OrgBundle\Entity\Statut $statut)
    {
        $this->statut = $statut;
    
        return $this;
    }

    /**
     * Get statut
     *
     * @return \Pablo\OrgBundle\Entity\Statut 
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set intitule
     *
     * @param \Pablo\OrgBundle\Entity\Cours $intitule
     * @return Attribution
     */
    public function setIntitule(\Pablo\OrgBundle\Entity\Cours $intitule = null)
    {
        $this->intitule = $intitule;
    
        return $this;
    }

    /**
     * Get intitule
     *
     * @return \Pablo\OrgBundle\Entity\Cours 
     */
    public function getIntitule()
    {
        return $this->intitule;
    }

    /**
     * Set specialite
     *
     * @param \Pablo\OrgBundle\Entity\Cours $specialite
     * @return Attribution
     */
    public function setSpecialite(\Pablo\OrgBundle\Entity\Cours $specialite = null)
    {
        $this->specialite = $specialite;
    
        return $this;
    }

    /**
     * Get specialite
     *
     * @return \Pablo\OrgBundle\Entity\Cours 
     */
    public function getSpecialite()
    {
        return $this->specialite;
    }
}