<?php
/**
 * Created by PhpStorm.
 * User: kadhem
 * Date: 11/13/17
 * Time: 9:38 PM
 */

namespace AnnonceBundle\Entity;

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
     * @ORM\OneToOne(targetEntity="AnnonceBundle\Entity\Address")
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
     * @ORM\Column(name="maxCoLocataire",type="integer")
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
}
