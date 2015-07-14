<?php

namespace HearWeGo\HearWeGoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rating
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="HearWeGo\HearWeGoBundle\Entity\Repository\RatingRepository")
 */
class Rating
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="stars", type="integer")
     */
    private $stars;

    /**
     * @ORM\ManyToOne(targetEntity="HearWeGo\HearWeGoBundle\Entity\User", inversedBy="rates", cascade={"persist"} )
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="HearWeGo\HearWeGoBundle\Entity\Audio", inversedBy="rates", cascade={"persist"} )
     */
    private $audio;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set stars
     *
     * @param integer $stars
     * @return Rating
     */
    public function setStars($stars)
    {
        $this->stars = $stars;

        return $this;
    }

    /**
     * Get stars
     *
     * @return integer 
     */
    public function getStars()
    {
        return $this->stars;
    }

    /**
     * Set user
     *
     * @param \HearWeGo\HearWeGoBundle\Entity\User $user
     * @return Rating
     */
    public function setUser(\HearWeGo\HearWeGoBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \HearWeGo\HearWeGoBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set audio
     *
     * @param \HearWeGo\HearWeGoBundle\Entity\Audio $audio
     * @return Rating
     */
    public function setAudio(\HearWeGo\HearWeGoBundle\Entity\Audio $audio = null)
    {
        $this->audio = $audio;

        return $this;
    }

    /**
     * Get audio
     *
     * @return \HearWeGo\HearWeGoBundle\Entity\Audio 
     */
    public function getAudio()
    {
        return $this->audio;
    }
}
