<?php
/**
 * Created by PhpStorm.
 * User: khiem
 * Date: 22/07/2015
 * Time: 11:03
 */

namespace HearWeGo\HearWeGoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Article
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="HearWeGo\HearWeGoBundle\Entity\Repository\GalleryRepository")
 */
class Gallery
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imgpath;

    /**
     * @Assert\File(maxSize="8024k", mimeTypes={"image/jpeg", "image/png", "image/bmp", "image/gif"} )
     */
    private $img;

    /**
     * @ORM\ManyToOne(targetEntity="HearWeGo\HearWeGoBundle\Entity\Destination", inversedBy="photos")
     * @ORM\JoinColumn(name="destination_id",referencedColumnName="id",onDelete="CASCADE")
     */
    private $destination;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param mixed $img
     */
    public function setImg(UploadedFile $img)
    {
        $this->img = $img;
    }

    /**
     * @return mixed
     */
    public function getImgpath()
    {
        return $this->imgpath;
    }

    /**
     * @param mixed $imgpath
     */
    public function setImgpath($imgpath)
    {
        $this->imgpath = $imgpath;
    }

    public function getAbsolutePath(){
        return null === $this->imgpath ? null : $this->getUploadRootDir()."/".$this->imgpath;
    }

    public function getWebPath(){
        return null === $this->imgpath ? null : $this->getUploadDir()."/".$this->imgpath;
    }

    public function getUploadRootDir(){
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    public function getUploadDir(){
        return '/bundles/hearwegohearwego/uploads/gallery';
    }

    public function upload() {
        if ( $this->getImg() === null )
            return;

        $this->getImg()->move(
            $this->getUploadRootDir(),
            $this->getImg()->getClientOriginalName()
        );

        $this->imgpath = $this->getImg()->getClientOriginalName();

        $this->img = null ;

    }

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
