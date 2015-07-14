<?php

namespace HearWeGo\HearWeGoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Audio
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Audio
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
     * @ORM\Column(name="content", type="string", length=255)
     */
    private $content;

    /**
     * @ORM\OneToMany(targetEntity="HearWeGo\HearWeGoBundle\Entity\Rating", mappedBy="audio")
     */
    private $rates;

    /**
     * @ORM\OneToOne(targetEntity="HearWeGo\HearWeGoBundle\Entity\Destination", inversedBy="audio")
     */
    private $destination;
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
     * @return Audio
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
     * Set content
     *
     * @param string $content
     * @return Audio
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->rates = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add rates
     *
     * @param \HearWeGo\HearWeGoBundle\Entity\Rating $rates
     * @return Audio
     */
    public function addRate(\HearWeGo\HearWeGoBundle\Entity\Rating $rates)
    {
        $this->rates[] = $rates;

        return $this;
    }

    /**
     * Remove rates
     *
     * @param \HearWeGo\HearWeGoBundle\Entity\Rating $rates
     */
    public function removeRate(\HearWeGo\HearWeGoBundle\Entity\Rating $rates)
    {
        $this->rates->removeElement($rates);
    }

    /**
     * Get rates
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRates()
    {
        return $this->rates;
    }

    /**
     * Set destination
     *
     * @param \HearWeGo\HearWeGoBundle\Entity\Destination $destination
     * @return Audio
     */
    public function setDestination(\HearWeGo\HearWeGoBundle\Entity\Destination $destination = null)
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * Get destination
     *
     * @return \HearWeGo\HearWeGoBundle\Entity\Destination 
     */
    public function getDestination()
    {
        return $this->destination;
    }
}
