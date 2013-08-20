<?php

/**
 * Ce fichier est une partie de l'application Pablo.
 *
 * @author Thomas Decraux <thomasdecraux@gmail.com>
 * @version <0.1.0>
 */

namespace Pablo\PeopleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Pablo\PeopleBundle\Validator as PAssert;

/**
 * Class Personne
 *
 * @ORM\Table(name="personne")
 * @ORM\Entity(repositoryClass="Pablo\PeopleBundle\Entity\PersonneRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discrimination", type="string")
 * @ORM\DiscriminatorMap({"personne" = "Personne", "employe" = "Employe"})
 */
class Personne
{
    /**
     * Clé primaire auto-incrémentée gérée par Doctrine
     * @var integer
     *
     * @ORM\Column(name="idpersonne", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Nom
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=120)
     *
     * @Assert\NotBlank()
     * @Assert\Length(min=3, max=120))
     */
    private $nom;

    /**
     * Prénom
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=120)
     *
     * @Assert\NotBlank()
     * @Assert\Length(min=3, max=120)
     */
    private $prenom;

    /**
     * Nationalité
     * @var \Pablo\PeopleBundle\Entity\Pays
     *
     * @ORM\ManyToOne(targetEntity="Pablo\PeopleBundle\Entity\Pays")
     * @ORM\JoinColumn(name="codepays", referencedColumnName="codepays", nullable=true)
     */
    private $pays;

    /**
     * Sexe
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=1)
     */
    private $sexe;

    /**
     * Date de naissance
     * @var \DateTime
     *
     * @ORM\Column(name="datenaissance", type="date", nullable=true)
     *
     * @PAssert\DateRange()
     */
    private $datenaissance;

    /**
     * Lieu de naissance
     * @var string
     *
     * @ORM\Column(name="lieunaissance", type="string", length=120, nullable=true)
     *
     * @Assert\Length(min=3, max=120)
     */
    private $lieunaissance;

    /**
     * Adresses
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Pablo\PeopleBundle\Entity\Adresse", mappedBy="personne")
     */
    private $adresses;

    /**
     * Numéros de téléphone
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Pablo\PeopleBundle\Entity\Telephone", mappedBy="personne")
     */
    private $telephones;

    /**
     * Adresses e-mail
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Pablo\PeopleBundle\Entity\Email", mappedBy="personne")
     */
    private $emails;

    /**
     * Commentaires des utilisateurs
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Pablo\PeopleBundle\Entity\Commentaire", mappedBy="personne")
     */
    private $commentaires;

    /**
     * Constructeur : initialise le sexe à 'F' et crée les instances de la classe ArrayCollection.
     */
    public function __construct()
    {
        $this->sexe = 'F';
        $this->adresses = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
        $this->Telephone = new ArrayCollection();
        $this->emails = new ArrayCollection();
    }

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
     * Set nom
     * Convertit le nom en majuscules (y compris les lettres accentuées)
     *
     * @param string $nom
     * @return Personne
     */
    public function setNom($nom)
    {
        $this->nom = mb_strtoupper($nom, 'utf-8');
    
        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     * Met en majuscule la première lettre du prénom (y compris les lettres accentuées)
     *
     * @param string $prenom
     * @return Personne
     */
    public function setPrenom($prenom)
    {
        $this->prenom = mb_convert_case($prenom, MB_CASE_TITLE, 'utf-8');

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     * @return Personne
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
    
        return $this;
    }

    /**
     * Get sexe
     *
     * @return string 
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set datenaissance
     *
     * @param \DateTime $datenaissance
     * @return Personne
     */
    public function setDatenaissance($datenaissance)
    {
        $this->datenaissance = $datenaissance;
    
        return $this;
    }

    /**
     * Get datenaissance
     *
     * @return \DateTime 
     */
    public function getDatenaissance()
    {
        return $this->datenaissance;
    }

    /**
     * Set lieunaissance
     *
     * @param string $lieunaissance
     * @return Personne
     */
    public function setLieunaissance($lieunaissance)
    {
        $this->lieunaissance = $lieunaissance;
    
        return $this;
    }

    /**
     * Get lieunaissance
     *
     * @return string 
     */
    public function getLieunaissance()
    {
        return $this->lieunaissance;
    }

    /**
     * Set pays
     *
     * @param \Pablo\PeopleBundle\Entity\Pays $pays
     * @return Personne
     */
    public function setPays(\Pablo\PeopleBundle\Entity\Pays $pays = null)
    {
        $this->pays = $pays;
    
        return $this;
    }

    /**
     * Get pays
     *
     * @return \Pablo\PeopleBundle\Entity\Pays 
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Add adresses
     *
     * @param \Pablo\PeopleBundle\Entity\Adresse $adresses
     * @return Personne
     */
    public function addAdresse(\Pablo\PeopleBundle\Entity\Adresse $adresses)
    {
        $this->adresses[] = $adresses;
    
        return $this;
    }

    /**
     * Remove adresses
     *
     * @param \Pablo\PeopleBundle\Entity\Adresse $adresses
     */
    public function removeAdresse(\Pablo\PeopleBundle\Entity\Adresse $adresses)
    {
        $this->adresses->removeElement($adresses);
    }

    /**
     * Get adresses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAdresses()
    {
        return $this->adresses;
    }

    /**
     * Add telephones
     *
     * @param \Pablo\PeopleBundle\Entity\Telephone $telephones
     * @return Personne
     */
    public function addTelephone(\Pablo\PeopleBundle\Entity\Telephone $telephones)
    {
        $this->telephones[] = $telephones;
    
        return $this;
    }

    /**
     * Remove telephones
     *
     * @param \Pablo\PeopleBundle\Entity\Telephone $telephones
     */
    public function removeTelephone(\Pablo\PeopleBundle\Entity\Telephone $telephones)
    {
        $this->telephones->removeElement($telephones);
    }

    /**
     * Get telephones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTelephones()
    {
        return $this->telephones;
    }

    /**
     * Add emails
     *
     * @param \Pablo\PeopleBundle\Entity\Email $emails
     * @return Personne
     */
    public function addEmail(\Pablo\PeopleBundle\Entity\Email $emails)
    {
        $this->emails[] = $emails;
    
        return $this;
    }

    /**
     * Remove emails
     *
     * @param \Pablo\PeopleBundle\Entity\Email $emails
     */
    public function removeEmail(\Pablo\PeopleBundle\Entity\Email $emails)
    {
        $this->emails->removeElement($emails);
    }

    /**
     * Get emails
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEmails()
    {
        return $this->emails;
    }

    /**
     * Add commentaires
     *
     * @param \Pablo\PeopleBundle\Entity\Commentaire $commentaires
     * @return Personne
     */
    public function addCommentaire(\Pablo\PeopleBundle\Entity\Commentaire $commentaires)
    {
        $this->commentaires[] = $commentaires;
    
        return $this;
    }

    /**
     * Remove commentaires
     *
     * @param \Pablo\PeopleBundle\Entity\Commentaire $commentaires
     */
    public function removeCommentaire(\Pablo\PeopleBundle\Entity\Commentaire $commentaires)
    {
        $this->commentaires->removeElement($commentaires);
    }

    /**
     * Get commentaires
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }
}