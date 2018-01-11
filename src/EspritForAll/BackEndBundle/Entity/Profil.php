<?php

namespace EspritForAll\BackEndBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Profil
 *
 * @ORM\Table(name="profil", indexes={@ORM\Index(name="fk_profil_utilisateur1_idx", columns={"user_id"})})
 * @ORM\Entity
 */
class Profil
{
    /**
     * @var string
     *
     * @ORM\Column(name="matiere_c", type="string", length=255, nullable=true)
     */
    private $matiereC;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="classe", type="string", length=255, nullable=true)
     */
    private $classe;

    /**
     * @var string
     *
     * @ORM\Column(name="path_img", type="string", length=255, nullable=true)
     */
    private $pathImg;


    /**
     * @var string
     *
     * @ORM\Column(name="path_cv", type="string", length=255, nullable=true)
     */
    private $pathCv;

    /**
     * @var string
     *
     * @ORM\Column(name="link_fb", type="string", length=255, nullable=true)
     */
    private $linkFb;

    /**
     * @var string
     *
     * @ORM\Column(name="link_ld", type="string", length=255, nullable=true)
     */
    private $linkLd;

    /**
     * @var string
     *
     * @ORM\Column(name="link_g", type="string", length=255, nullable=true)
     */
    private $linkG;

    /**
     * @var string
     *
     * @ORM\Column(name="path_couverture", type="string", length=255, nullable=true)
     */
    private $linkcouverture;

    /**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", length=255, nullable=true)
     */
    private $tel;

    /**
     * @var integer
     *
     * @ORM\Column(name="age", type="integer", nullable=true)
     */
    private $age;

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
    public function getMatiereC()
    {
        return $this->matiereC;
    }

    /**
     * @param string $matiereC
     */
    public function setMatiereC($matiereC)
    {
        $this->matiereC = $matiereC;
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
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     * @param string $classe
     */
    public function setClasse($classe)
    {
        $this->classe = $classe;
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
    public function getPathCv()
    {
        return $this->pathCv;
    }

    /**
     * @param string $pathCv
     */
    public function setPathCv($pathCv)
    {
        $this->pathCv = $pathCv;
    }

    /**
     * @return string
     */
    public function getLinkFb()
    {
        return $this->linkFb;
    }

    /**
     * @param string $linkFb
     */
    public function setLinkFb($linkFb)
    {
        $this->linkFb = $linkFb;
    }

    /**
     * @return string
     */
    public function getLinkLd()
    {
        return $this->linkLd;
    }

    /**
     * @param string $linkLd
     */
    public function setLinkLd($linkLd)
    {
        $this->linkLd = $linkLd;
    }

    /**
     * @return string
     */
    public function getLinkG()
    {
        return $this->linkG;
    }

    /**
     * @param string $linkG
     */
    public function setLinkG($linkG)
    {
        $this->linkG = $linkG;
    }

    /**
     * @return string
     */
    public function getLinkcouverture()
    {
        return $this->linkcouverture;
    }

    /**
     * @param string $linkcouverture
     */
    public function setLinkcouverture($linkcouverture)
    {
        $this->linkcouverture = $linkcouverture;
    }

    /**
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * @param string $tel
     */
    public function setTel($tel)
    {
        $this->tel = $tel;
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

    /**
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param int $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }
}

