<?php
/**
 * Created by PhpStorm.
 * User: kadhem
 * Date: 11/13/17
 * Time: 9:38 PM
 */

namespace AnnonceBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="annoncecolocation")
 *
 */
class AnnonceCoLocation
{
    /**
     * @ORM\Column(name="id" ,type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Id
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="AnnonceBundle\Entity\Address",cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     *
     */

    private $address;
    /**
     * @ORM\Column(name="dimensions",type="string")
     *
     */
    private $dimensions;


    /**
     * @ORM\Column(name="maxCoLocataire",type="integer",)
     */
    private $maxCoLocataire;


    /**
     * @ORM\Column(name="loyer",type="float")
     */
    private $loyer;


    /**
     * @ORM\Column(name="name",type="string")
     */
    private $name;
    /**
     * @ORM\ManyToMany(targetEntity="AnnonceBundle\Entity\Photo" ,cascade={"persist"})
     *
     */
    private $photos;

    /**
     * @return mixed
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * @param mixed $photos
     */
    public function setPhotos($photos)
    {
        $this->photos = $photos;
    }

    /**
     * @return mixed
     */
    public function getCoLocatires()
    {
        return $this->coLocatires;
    }

    /**
     * @param mixed $coLocatires
     */
    public function setCoLocatires($coLocatires)
    {
        $this->coLocatires = $coLocatires;
    }

    /**
     * @return mixed
     */
    public function getDemandeurs()
    {
        return $this->demandeurs;
    }

    /**
     * @param mixed $demandeurs
     */
    public function setDemandeurs($demandeurs)
    {
        $this->demandeurs = $demandeurs;
    }


    /**
     * @ORM\Column(name="description",type="string")
     */

    private $description;
    /**
     * @ORM\ManyToOne(targetEntity="EspritForAll\BackEndBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */


    private $owner;

    /**
     * @ORM\Column(name="creationDate",type="date")
     */


    private $creationDate;

    /**
     * @ORM\Column(name="expirationDate",type="date")
     */
    private $expirationDate;
    /**
     * @ORM\ManyToMany(targetEntity="EspritForAll\BackEndBundle\Entity\User")
     * @ORM\JoinTable(name="colocation_user_coLocataire")
     */
    private $coLocatires;
    /**
     * @ORM\ManyToMany(targetEntity="EspritForAll\BackEndBundle\Entity\User")
     * @ORM\JoinTable(name="colocation_user_demandeur")
     */
    private $demandeurs;


    /**
     * AnnonceCoLocation constructor.
     */

    public function __construct()
    {
        $this->photos = new ArrayCollection();
        $this->demandeurs = new ArrayCollection();
        $this->coLocatires = new ArrayCollection();
    }

    public function addCoLocataire($user)
    {
        $this->coLocatires->add($user);

    }
    public function addDemandeur($user)
    {
        $this->demandeurs->add($user);

    }
    public function addPhoto($photo)
    {
        $this->photos->add($photo);

    }
    public function removeCoLocataire($user)
    {
        $this->coLocatires->removeElement($user);

    }
    public function removeDemandeur($user)
    {
        $this->demandeurs->removeElement($user);

    }
    public function removePhoto($photo)
    {
        $this->photos->remove($photo);

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
     * Set dimensions
     *
     * @param string $dimensions
     *
     * @return AnnonceCoLocation
     */
    public function setDimensions($dimensions)
    {
        $this->dimensions = $dimensions;

        return $this;
    }

    /**
     * Get dimensions
     *
     * @return string
     */
    public function getDimensions()
    {
        return $this->dimensions;
    }

    /**
     * Set maxCoLocataire
     *
     * @param integer $maxCoLocataire
     *
     * @return AnnonceCoLocation
     */
    public function setMaxCoLocataire($maxCoLocataire)
    {
        $this->maxCoLocataire = $maxCoLocataire;

        return $this;
    }

    /**
     * Get maxCoLocataire
     *
     * @return integer
     */
    public function getMaxCoLocataire()
    {
        return $this->maxCoLocataire;
    }

    /**
     * Set loyer
     *
     * @param float $loyer
     *
     * @return AnnonceCoLocation
     */
    public function setLoyer($loyer)
    {
        $this->loyer = $loyer;

        return $this;
    }

    /**
     * Get loyer
     *
     * @return float
     */
    public function getLoyer()
    {
        return $this->loyer;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return AnnonceCoLocation
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return AnnonceCoLocation
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

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     *
     * @return AnnonceCoLocation
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set expirationDate
     *
     * @param \DateTime $expirationDate
     *
     * @return AnnonceCoLocation
     */
    public function setExpirationDate($expirationDate)
    {
        $this->expirationDate = $expirationDate;

        return $this;
    }

    /**
     * Get expirationDate
     *
     * @return \DateTime
     */
    public function getExpirationDate()
    {
        return $this->expirationDate;
    }

    /**
     * Set address
     *
     * @param \AnnonceBundle\Entity\Address $address
     *
     * @return AnnonceCoLocation
     */
    public function setAddress(\AnnonceBundle\Entity\Address $address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return \AnnonceBundle\Entity\Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set owner
     *
     * @param \EspritForAll\BackEndBundle\Entity\User $owner
     *
     * @return AnnonceCoLocation
     */
    public function setOwner(\EspritForAll\BackEndBundle\Entity\User $owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return \EspritForAll\BackEndBundle\Entity\User
     */
    public function getOwner()
    {
        return $this->owner;
    }
    public function isThereStillPlace()
    {

        return  count($this->getDemandeurs()) + count($this->getCoLocatires()) < $this->getMaxCoLocataire();
    }
    public function isUserAuthorized($user)
    {

        return $user->getId() == $this->getOwner()->getId() or $user->hasRole('ROLE_ADMIN');
    }
    public function isUserParticipating($user)
    {
        return $this->getDemandeurs()->contains($user) or $this->getCoLocatires()->contains($user);
    }
}
