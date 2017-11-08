<?php

namespace EspritForAll\BackEndBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UtilisateurHasCollocation
 *
 * @ORM\Table(name="utilisateur_accept_revision", indexes={@ORM\Index(name="fk_user_accept_revision_idx", columns={"revision_id"}), @ORM\Index(name="fk_user_accept_revision2_idx", columns={"user_id"})})
 * @ORM\Entity
 */
class UtilisateurAcceptRevision
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
     * @var \EspritForAll\BackEndBundle\Entity\Revision
     *
     * @ORM\ManyToOne(targetEntity="EspritForAll\BackEndBundle\Entity\Revision")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="revision_id", referencedColumnName="id")
     * })
     */
    private $revision;

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
     * @var boolean
     *
     * @ORM\Column(name="acceptation", type="boolean", nullable=true)
     */
    private $acceptation;


}

