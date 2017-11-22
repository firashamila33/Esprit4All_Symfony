<?php

namespace EspritForAll\BackEndBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LigneCommande
 *
 * @ORM\Table(name="ligne_commande", indexes={@ORM\Index(name="fk_ligne_commande_commande1_idx", columns={"commande_id"}), @ORM\Index(name="fk_ligne_commande_menu1_idx", columns={"menu_id"})})
 * @ORM\Entity
 */
class LigneCommande
{
    /**
     * @var integer
     *
     * @ORM\Column(name="quantite", type="integer", nullable=true)
     */
    private $quantite;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \EspritForAll\BackEndBundle\Entity\Commande
     *
     * @ORM\ManyToOne(targetEntity="EspritForAll\BackEndBundle\Entity\Commande")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="commande_id", referencedColumnName="id")
     * })
     */
    private $commande;

    /**
     * @var \EspritForAll\BackEndBundle\Entity\Menu
     *
     * @ORM\ManyToOne(targetEntity="EspritForAll\BackEndBundle\Entity\Menu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="menu_id", referencedColumnName="id")
     * })
     */
    private $menu;

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
     * @return Commande
     */
    public function getCommande()
    {
        return $this->commande;
    }

    /**
     * @param Commande $commande
     */
    public function setCommande($commande)
    {
        $this->commande = $commande;
    }

    /**
     * @return Menu
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * @param Menu $menu
     */
    public function setMenu($menu)
    {
        $this->menu = $menu;
    }


}

