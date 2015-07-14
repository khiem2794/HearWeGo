<?php

namespace HearWeGo\HearWeGoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Destination
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Destination
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="decimal")
     */
    private $location;

    /**
     * @ORM\OneToMany(targetEntity="HearWeGo\HearWeGoBundle\Entity\Audio", mappedBy="destination")
     */
    private $audio;

    /**
     * @ORM\OneToMany(targetEntity="HearWeGo\HearWeGoBundle\Entity\Article", mappedBy="destination")
     */
    private $articles;


    /**
     * @ORM\ManyToMany(targetEntity="HearWeGo\HearWeGoBundle\Entity\Tour", inversedBy="destinations")
     * @ORM\JoinTable(name="tours_destinations")
     */
    private $tours;

    function __construct()
    {
        $this->article = new ArrayCollection();
        $this->tours = new ArrayCollection();
    }

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
     * Set name
     *
     * @param string $name
     * @return Destination
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set location
     *
     * @param string $location
     * @return Destination
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Add audio
     *
     * @param \HearWeGo\HearWeGoBundle\Entity\Audio $audio
     * @return Destination
     */
    public function addAudio(\HearWeGo\HearWeGoBundle\Entity\Audio $audio)
    {
        $this->audio[] = $audio;

        return $this;
    }

    /**
     * Remove audio
     *
     * @param \HearWeGo\HearWeGoBundle\Entity\Audio $audio
     */
    public function removeAudio(\HearWeGo\HearWeGoBundle\Entity\Audio $audio)
    {
        $this->audio->removeElement($audio);
    }

    /**
     * Get audio
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAudio()
    {
        return $this->audio;
    }

    /**
     * Add articles
     *
     * @param \HearWeGo\HearWeGoBundle\Entity\Article $articles
     * @return Destination
     */
    public function addArticle(\HearWeGo\HearWeGoBundle\Entity\Article $articles)
    {
        $this->articles[] = $articles;

        return $this;
    }

    /**
     * Remove articles
     *
     * @param \HearWeGo\HearWeGoBundle\Entity\Article $articles
     */
    public function removeArticle(\HearWeGo\HearWeGoBundle\Entity\Article $articles)
    {
        $this->articles->removeElement($articles);
    }

    /**
     * Get articles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * Add tours
     *
     * @param \HearWeGo\HearWeGoBundle\Entity\Tour $tours
     * @return Destination
     */
    public function addTour(\HearWeGo\HearWeGoBundle\Entity\Tour $tours)
    {
        $this->tours[] = $tours;

        return $this;
    }

    /**
     * Remove tours
     *
     * @param \HearWeGo\HearWeGoBundle\Entity\Tour $tours
     */
    public function removeTour(\HearWeGo\HearWeGoBundle\Entity\Tour $tours)
    {
        $this->tours->removeElement($tours);
    }

    /**
     * Get tours
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTours()
    {
        return $this->tours;
    }
}
