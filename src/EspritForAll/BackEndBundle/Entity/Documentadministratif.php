<?php

namespace EspritForAll\BackEndBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Documentadministratif
 *
 * @ORM\Table(name="documentadministratif", indexes={@ORM\Index(name="fk_documentadministratif_utilisateur1_idx", columns={"user_id"})})
 * @ORM\Entity
 */
class Documentadministratif
{
    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="quantite", type="string", length=255, nullable=true)
     */
    private $quantite;

    /**
     * @var boolean
     *
     * @ORM\Column(name="confirmation", type="boolean", nullable=true)
     */
    private $confirmation;

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

