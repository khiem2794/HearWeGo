<?php
/**
 * Created by PhpStorm.
 * User: khiem
 * Date: 14/07/2015
 * Time: 14:48
 */
namespace HearWeGo\HearWeGoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="HearWeGo\HearWeGoBundle\Entity\Repository\OrderRepository")
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $date;
    /**
     * @ORM\ManyToMany(targetEntity="HearWeGo\HearWeGoBundle\Entity\Audio", inversedBy="orders")
     */
    private $audios;

    /**
     * @ORM\ManyToOne(targetEntity="HearWeGo\HearWeGoBundle\Entity\User", inversedBy="orders")
     */
    private $user;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->audios = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add audios
     *
     * @param \HearWeGo\HearWeGoBundle\Entity\Audio $audios
     * @return Order
     */
    public function addAudio(\HearWeGo\HearWeGoBundle\Entity\Audio $audios)
    {
        $this->audios[] = $audios;

        return $this;
    }

    /**
     * Remove audios
     *
     * @param \HearWeGo\HearWeGoBundle\Entity\Audio $audios
     */
    public function removeAudio(\HearWeGo\HearWeGoBundle\Entity\Audio $audios)
    {
        $this->audios->removeElement($audios);
    }

    /**
     * Get audios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAudios()
    {
        return $this->audios;
    }

    /**
     * Set user
     *
     * @param \HearWeGo\HearWeGoBundle\Entity\User $user
     * @return Order
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
     * Set date
     *
     * @param \DateTime $date
     * @return Order
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }
}
