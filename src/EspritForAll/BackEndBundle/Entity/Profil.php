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

