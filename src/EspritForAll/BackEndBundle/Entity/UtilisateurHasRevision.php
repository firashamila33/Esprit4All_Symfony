<?php

namespace EspritForAll\BackEndBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UtilisateurHasRevision
 *
 * @ORM\Table(name="utilisateur_has_revision", indexes={@ORM\Index(name="fk_utilisateur_has_revision_revision1_idx", columns={"revision_id"}), @ORM\Index(name="fk_utilisateur_has_revision_utilisateur1_idx", columns={"user_id"})})
 * @ORM\Entity
 */
class UtilisateurHasRevision
{
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
     * @return Revision
     */
    public function getRevision()
    {
        return $this->revision;
    }

    /**
     * @param Revision $revision
     */
    public function setRevision($revision)
    {
        $this->revision = $revision;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }
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


}

