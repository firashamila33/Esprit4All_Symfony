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


}

