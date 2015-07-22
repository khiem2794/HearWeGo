<?php

namespace HearWeGo\HearWeGoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Article
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="HearWeGo\HearWeGoBundle\Entity\Repository\ArticleRepository")
 */
class Article
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
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\NotBlank(message="This field must be filled")
     * 
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     * @Assert\NotBlank(message="This field must be filled")
     * 
     */
    private $content;

    /**
     * @ORM\Column(name="imgpath", type="string", nullable=false)
     * @Assert\NotBlank()
     */
    private $imgpath;

    /**
     * @Assert\File(maxSize="2024k", mimeTypes={"image/jpeg", "image/png", "image/bmp", "image/gif"} )
     */
    private $img;

    /**
     * @ORM\OneToMany(targetEntity="HearWeGo\HearWeGoBundle\Entity\Comment", mappedBy="article")
     */
    private $comments;

    /**
     * @ORM\ManyToOne(targetEntity="HearWeGo\HearWeGoBundle\Entity\Destination", inversedBy="articles")
     */
    private $destination;

    /**
     * @ORM\ManyToMany(targetEntity="Tag", indexBy="name", fetch="EAGER")
     * @ORM\JoinTable(name="article_tags",
     *      joinColumns={@ORM\JoinColumn(name="article_id", referencedColumnName="id", onDelete="CASCADE")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id", onDelete="CASCADE")}
     *      )
     * */
    private $tags;

    function __construct()
    {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comments = new ArrayCollection();
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
     * Set title
     *
     * @param string $title
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Article
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
     * Add comments
     *
     * @param \HearWeGo\HearWeGoBundle\Entity\Comment $comments
     * @return Article
     */
    public function addComment(\HearWeGo\HearWeGoBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \HearWeGo\HearWeGoBundle\Entity\Comment $comments
     */
    public function removeComment(\HearWeGo\HearWeGoBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set destination
     *
     * @param \HearWeGo\HearWeGoBundle\Entity\Destination $destination
     * @return Article
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

    /**
     * Add tags
     *
     * @param \HearWeGo\HearWeGoBundle\Entity\Tag $tags
     * @return Article
     */
    public function addTag(\HearWeGo\HearWeGoBundle\Entity\Tag $tags)
    {
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param \HearWeGo\HearWeGoBundle\Entity\Tag $tags
     */
    public function removeTag(\HearWeGo\HearWeGoBundle\Entity\Tag $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set imgpath
     *
     * @param string $imgpath
     * @return Article
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
     * @return mixed
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param mixed $img
     */
    public function setImg($img)
    {
        $this->img = $img;
    }



    public function getAbsolutePath()
    {
        return null === $this->imgpath
            ? null
            : $this->getUploadRootDir().'/'.$this->imgpath;
    }

    public function getWebPath()
    {
        return null === $this->imgpath
            ? null
            : $this->getUploadDir().'/'.$this->imgpath;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return '/bundles/hearwegohearwego/uploads/articleimg';
    }

    public function upload()
    {
        // the file property can be empty if the field is not required
        if (null === $this->getImg()) {
            return;
        }

        // use the original file name here but you should
        // sanitize it at least to avoid any security issues

        // move takes the target directory and then the
        // target filename to move to
        $this->getImg()->move(
            $this->getUploadRootDir(),
            $this->getImg()->getClientOriginalName()
        );

        // set the path property to the filename where you've saved the file
        $this->imgpath = $this->getImg()->getClientOriginalName();

        // clean up the file property as you won't need it anymore
        $this->img = null;
    }



}
