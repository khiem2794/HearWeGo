<?php

namespace HearWeGo\HearWeGoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class Comment
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=255)
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="HearWeGo\HearWeGoBundle\Entity\User", inversedBy="comments")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $user;


    /**
     * @ORM\ManyToOne(targetEntity="HearWeGo\HearWeGoBundle\Entity\Article", inversedBy="comments")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $article;

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
     * Set date
     *
     * @param \DateTime $date
     * @return Comment
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

    /**
     * Set content
     *
     * @param string $content
     * @return Comment
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
     * Set user
     *
     * @param \HearWeGo\HearWeGoBundle\Entity\User $user
     * @return Comment
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
     * Set article
     *
     * @param \HearWeGo\HearWeGoBundle\Entity\Article $article
     * @return Comment
     */
    public function setArticle(\HearWeGo\HearWeGoBundle\Entity\Article $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \HearWeGo\HearWeGoBundle\Entity\Article 
     */
    public function getArticle()
    {
        return $this->article;
    }
}
