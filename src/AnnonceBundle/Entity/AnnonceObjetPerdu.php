<?php
/**
 * Created by PhpStorm.
 * User: kadhem
 * Date: 11/13/17
 * Time: 3:07 PM
 */

namespace AnnonceBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="annonceobjetperdu")
 * @ORM\Entity
 */
class AnnonceObjetPerdu
{
    /**
     * @ORM\Column(name="id",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column(name="name",type="string")
     *
     */
    private $name;
    /**
     * @ORM\Column(name="description",type="string")
     *
     */

    private $description;
    /**
     * @ORM\ManyToOne(targetEntity="EspritForAll\BackEndBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     *
     */

    private $owner;
    /**
     * @ORM\Column(name="creationDate",type="date")
     *
     */

    private $creationDate;
    /**
     * @ORM\Column(name="expirationDate",type="date")
     *
     */

    private $expirationDate;
    /**
     * @ORM\Column(name="objectDescription",type="string")
     *
     */

    private $objectDescription;
    /**
     * @ORM\Column(name="lossDate",type="date")
     *
     */


    private $lossDate;
    /**
     * @ORM\Column(name="lossLocation",type="string")
     *
     */

    private $lossLocation;


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
     * Set name
     *
     * @param string $name
     *
     * @return AnnonceObjetPerdu
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
     * @return AnnonceObjetPerdu
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
     * Set owner
     *
     * @param integer $owner
     *
     * @return AnnonceObjetPerdu
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return integer
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     *
     * @return AnnonceObjetPerdu
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
     * @return AnnonceObjetPerdu
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
     * Set objectDesciption
     *
     * @param string $objectDesciption
     *
     * @return AnnonceObjetPerdu
     */
    public function setObjectDesciption($objectDesciption)
    {
        $this->objectDesciption = $objectDesciption;

        return $this;
    }

    /**
     * Get objectDesciption
     *
     * @return string
     */
    public function getObjectDesciption()
    {
        return $this->objectDesciption;
    }

    /**
     * Set lossDate
     *
     * @param \DateTime $lossDate
     *
     * @return AnnonceObjetPerdu
     */
    public function setLossDate($lossDate)
    {
        $this->lossDate = $lossDate;

        return $this;
    }

    /**
     * Get lossDate
     *
     * @return \DateTime
     */
    public function getLossDate()
    {
        return $this->lossDate;
    }

    /**
     * Set lossLocation
     *
     * @param string $lossLocation
     *
     * @return AnnonceObjetPerdu
     */
    public function setLossLocation($lossLocation)
    {
        $this->lossLocation = $lossLocation;

        return $this;
    }

    /**
     * Get lossLocation
     *
     * @return string
     */
    public function getLossLocation()
    {
        return $this->lossLocation;
    }

    /**
     * Set objectDescription
     *
     * @param string $objectDescription
     *
     * @return AnnonceObjetPerdu
     */
    public function setObjectDescription($objectDescription)
    {
        $this->objectDescription = $objectDescription;

        return $this;
    }

    /**
     * Get objectDescription
     *
     * @return string
     */
    public function getObjectDescription()
    {
        return $this->objectDescription;
    }
}
