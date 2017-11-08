<?php

namespace EspritForAll\BackEndBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Collocation
 *
 * @ORM\Table(name="collocation", indexes={@ORM\Index(name="fk_collocation_utilisateur1_idx", columns={"user_id"})})
 * @ORM\Entity
 */
class Collocation
{
    /**
     * @var string
     *
     * @ORM\Column(name="endroit", type="string", length=255, nullable=true)
     */
    private $endroit;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbrecollocataire", type="integer", nullable=true)
     */
    private $nbrecollocataire;

    /**
     * @var string
     *
     * @ORM\Column(name="descritpion", type="text", length=65535, nullable=true)
     */
    private $descritpion;

    /**
     * @var string
     *
     * @ORM\Column(name="prix", type="string", length=255, nullable=true)
     */
    private $prix;

    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float", precision=10, scale=0, nullable=true)
     */
    private $latitude;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float", precision=10, scale=0, nullable=true)
     */
    private $longitude;

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


}

