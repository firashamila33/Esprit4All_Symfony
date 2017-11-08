<?php

namespace EspritForAll\BackEndBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UtilisateurHasCovoiturage
 *
 * @ORM\Table(name="commentaire", indexes={@ORM\Index(name="fk_utilisateur_commentaire1_idx", columns={"evenement_id"}), @ORM\Index(name="fk_utilisateur_has_covoiturage_utilisateur1_idx", columns={"user_id"})})
 * @ORM\Entity
 */
class Commentaire
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
     * @var \EspritForAll\BackEndBundle\Entity\Evenement
     *
     * @ORM\ManyToOne(targetEntity="EspritForAll\BackEndBundle\Entity\Evenement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="evenement_id", referencedColumnName="id")
     * })
     */
    private $evenement;

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
     * @ORM\Column( name="note",type="text")
     */
    private $commentaire;


}

