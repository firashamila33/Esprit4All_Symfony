<?php

namespace EspritForAll\BackEndBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Menu
 *
 * @ORM\Table(name="menu")
 * @ORM\Entity
 */
class Menu
{
    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255, nullable=true)
     */
    public $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     */
    public $type;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string",options={"Boisson","Goûté","Fast Food","Plat"}, length=255, nullable=true)
     */
    public $categorie;
    /**
     * @var string
     *
     * @ORM\Column(name="endroit", type="string", length=45, nullable=true)
     */
    public $endroit;

    /**
     * @var boolean
     *
     * @ORM\Column(name="disponibilite", type="boolean", nullable=true)
     */
    public $disponibilite;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantite", type="integer", nullable=true)
     */
    public $quantite;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=true)
     */
    public $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="path_img", type="string", length=255, nullable=true)
     */
    public $pathImg;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public $id;

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
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param string $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    /**
     * @return string
     */
    public function getEndroit()
    {
        return $this->endroit;
    }

    /**
     * @param string $endroit
     */
    public function setEndroit($endroit)
    {
        $this->endroit = $endroit;
    }

    /**
     * @return bool
     */
    public function isDisponibilite()
    {
        return $this->disponibilite;
    }

    /**
     * @param bool $disponibilite
     */
    public function setDisponibilite($disponibilite)
    {
        $this->disponibilite = $disponibilite;
    }

    /**
     * @return int
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * @param int $quantite
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
    }

    /**
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param float $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
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

    
}

