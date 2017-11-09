<?php

namespace EspritForAll\BackEndBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Club
 *
 * @ORM\Table(name="club", indexes={@ORM\Index(name="fk_club_utilisateur1_idx", columns={"user_id"})})
 * @ORM\Entity
 */
class Club
{
    /**
     * @var string
     *
     * @ORM\Column(name="Libelle", type="string", length=255, nullable=true)
     */
    private $libelle;

    /**
     * @var text
     *
     * @ORM\Column(name="apropos", type="text",  nullable=true)
     */
    private $apropos;

    /**
     * @var text
     *
     * @ORM\Column(name="notreHistoire", type="text",  nullable=true)
     */
    private $notreHistoire;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="path_img", type="string", length=255, nullable=true)
     */
    private $pathImg;

    /**
     * @var string
     *
     * @ORM\Column(name="path_couverture", type="string", length=255, nullable=true)
     */
    private $pathCouverture;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \EspritForAll\BackEndBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="EspritForAll\BackEndBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param string $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    /**
     * @return text
     */
    public function getApropos()
    {
        return $this->apropos;
    }

    /**
     * @param text $apropos
     */
    public function setApropos($apropos)
    {
        $this->apropos = $apropos;
    }

    /**
     * @return text
     */
    public function getNotreHistoire()
    {
        return $this->notreHistoire;
    }

    /**
     * @param text $notreHistoire
     */
    public function setNotreHistoire($notreHistoire)
    {
        $this->notreHistoire = $notreHistoire;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getPathImg()
    {
        return $this->pathImg;
    }

    /**
     * @param string $pathImg
     */
    public function setPathImg($pathImg)
    {
        $this->pathImg = $pathImg;
    }

    /**
     * @return string
     */
    public function getPathCouverture()
    {
        return $this->pathCouverture;
    }

    /**
     * @param string $pathCouverture
     */
    public function setPathCouverture($pathCouverture)
    {
        $this->pathCouverture = $pathCouverture;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }


}

