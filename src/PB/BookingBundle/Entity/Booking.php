<?php

namespace PB\BookingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Booking
 *
 * @ORM\Table(name="booking")
 * @ORM\Entity(repositoryClass="PB\BookingBundle\Repository\BookingRepository")
 */
class Booking {
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start", type="datetime")
     * @Assert\DateTime()
     */
    private $start;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end", type="datetime")
     * @Assert\DateTime()
     */
    private $end;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_hosts", type="integer")
     * @Assert\Range(min=1, max=2)
     */
    private $nbHosts;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     * @Assert\NotBlank()
     */
    private $content;

    /**
     * @var bool
     *
     * @ORM\Column(name="accepted", type="boolean", nullable=true)
     */
    private $accepted;

    /**
     * @ORM\ManyToOne(targetEntity="PB\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;



    public function __construct() {
        $this->start = new \Datetime();
        $this->end = new \Datetime();
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set start
     *
     * @param \DateTime $start
     *
     * @return Booking
     */
    public function setStart($start) {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return \DateTime
     */
    public function getStart() {
        return $this->start;
    }

    /**
     * Set end
     *
     * @param \DateTime $end
     *
     * @return Booking
     */
    public function setEnd($end) {
        $this->end = $end;

        return $this;
    }

    /**
     * Get end
     *
     * @return \DateTime
     */
    public function getEnd() {
        return $this->end;
    }

    /**
     * Set nbHosts
     *
     * @param integer $nbHosts
     *
     * @return Booking
     */
    public function setNbHosts($nbHosts) {
        $this->nbHosts = $nbHosts;

        return $this;
    }

    /**
     * Get nbHosts
     *
     * @return int
     */
    public function getNbHosts() {
        return $this->nbHosts;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Booking
     */
    public function setContent($content) {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * Set accepted
     *
     * @param boolean $accepted
     *
     * @return Booking
     */
    public function setAccepted($accepted) {
        $this->accepted = $accepted;

        return $this;
    }

    /**
     * Get accepted
     *
     * @return bool
     */
    public function getAccepted() {
        return $this->accepted;
    }

    /**
     * Set user
     *
     * @param \PB\UserBundle\Entity\User $user
     *
     * @return Booking
     */
    public function setUser(\PB\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \PB\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
