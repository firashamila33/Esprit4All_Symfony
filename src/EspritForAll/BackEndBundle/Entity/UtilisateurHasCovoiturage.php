<?php

namespace EspritForAll\BackEndBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UtilisateurHasCovoiturage
 *
 * @ORM\Table(name="utilisateur_has_covoiturage", indexes={@ORM\Index(name="fk_utilisateur_has_covoiturage_covoiturage1_idx", columns={"covoiturage_id"}), @ORM\Index(name="fk_utilisateur_has_covoiturage_utilisateur1_idx", columns={"user_id"})})
 * @ORM\Entity
 */
class UtilisateurHasCovoiturage
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \EspritForAll\BackEndBundle\Entity\Covoiturage
     *
     * @ORM\ManyToOne(targetEntity="EspritForAll\BackEndBundle\Entity\Covoiturage")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="covoiturage_id", referencedColumnName="id")
     * })
     */
    private $covoiturage;

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

