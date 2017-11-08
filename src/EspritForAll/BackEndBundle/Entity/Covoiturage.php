<?php

namespace EspritForAll\BackEndBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Covoiturage
 *
 * @ORM\Table(name="covoiturage", indexes={@ORM\Index(name="fk_covoiturage_utilisateur1_idx", columns={"user_id"})})
 * @ORM\Entity
 */
class Covoiturage
{
    /**
     * @var string
     *
     * @ORM\Column(name="voiture", type="string", length=255, nullable=true)
     */
    private $voiture;


    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=true)
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="depart", type="string", length=255, nullable=true)
     */
    private $depart;

    /**
     * @var string
     *
     * @ORM\Column(name="arrive", type="string", length=255, nullable=true)
     */
    private $arrive;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbreplace", type="integer", nullable=true)
     */
    private $nbreplace;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure_depart", type="datetime", length=45, nullable=true)
     */
    private $heureDepart;

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

