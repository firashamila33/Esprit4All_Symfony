<?php

namespace EspritForAll\BackEndBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UtilisateurHasCollocation
 *
 * @ORM\Table(name="utilisateur_has_collocation", indexes={@ORM\Index(name="fk_utilisateur_has_collocation_collocation1_idx", columns={"collocation_id"}), @ORM\Index(name="fk_utilisateur_has_collocation_utilisateur1_idx", columns={"user_id"})})
 * @ORM\Entity
 */
class UtilisateurHasCollocation
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
     * @var \EspritForAll\BackEndBundle\Entity\Collocation
     *
     * @ORM\ManyToOne(targetEntity="EspritForAll\BackEndBundle\Entity\Collocation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="collocation_id", referencedColumnName="id")
     * })
     */
    private $collocation;

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

