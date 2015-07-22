<?php

namespace HearWeGo\HearWeGoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gallery
 */
class Gallery
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $imgpath;


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
     * Set imgpath
     *
     * @param string $imgpath
     * @return Gallery
     */
    public function setImgpath($imgpath)
    {
        $this->imgpath = $imgpath;

        return $this;
    }

    /**
     * Get imgpath
     *
     * @return string 
     */
    public function getImgpath()
    {
        return $this->imgpath;
    }
    /**
     * @var \HearWeGo\HearWeGoBundle\Entity\Destination
     */
    private $destination;


    /**
     * Set destination
     *
     * @param \HearWeGo\HearWeGoBundle\Entity\Destination $destination
     * @return Gallery
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
