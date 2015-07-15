<?php
/**
 * Created by PhpStorm.
 * User: khiem
 * Date: 13/07/2015
 * Time: 16:08
 */

namespace HearWeGo\HearWeGoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass="HearWeGo\HearWeGoBundle\Entity\Repository\UserRepository")
 * @ORM\Table(name="user")
 *
 * @UniqueEntity("email")
 */
class User
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="This field must be filled")
     * 
     */
    private $password;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="This field must be filled")
     * 
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="This field must be filled")
     * 
     * @Assert\Length(max=30,maxMessage="Cannot be longer than 30 characters")
     */
    private $firstName;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="This field must be filled")
     * 
     * @Assert\Length(max=30,maxMessage="Cannot be longer than 30 characters")
     */
    private $lastName;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank(message="This field must be filled")
     * 
     * @Assert\DateTime()
     */
    private $dateOfBirth;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="This field must be filled")
     * 
     * @Assert\Regex("[0-9]+")
     * @Assert\Length(min=9, max=11)
     */
    private $phone;

    /**
     * @ORM\OneToMany(targetEntity="HearWeGo\HearWeGoBundle\Entity\Comment", mappedBy="user")
     */
    private $comments;

    /**
     * @ORM\ManyToMany(targetEntity="HearWeGo\HearWeGoBundle\Entity\Role", mappedBy="users")
     */
    private $roles;

    /**
     * @ORM\OneToMany(targetEntity="HearWeGo\HearWeGoBundle\Entity\Rating", mappedBy="user")
     * @Assert\NotBlank(message="This field must be filled")
     * 
     */
    private $rates;

    /**
     * @ORM\OneToMany(targetEntity="HearWeGo\HearWeGoBundle\Entity\Order", mappedBy="user")
     */
    private $orders;

    function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->roles = new ArrayCollection();
        $this->rates = new ArrayCollection();
        $this->orders = new ArrayCollection();
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
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set dateOfBirth
     *
     * @param \DateTime $dateOfBirth
     * @return User
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    /**
     * Get dateOfBirth
     *
     * @return \DateTime 
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Add comments
     *
     * @param \HearWeGo\HearWeGoBundle\Entity\Comment $comments
     * @return User
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
     * Add roles
     *
     * @param \HearWeGo\HearWeGoBundle\Entity\Role $roles
     * @return User
     */
    public function addRole(\HearWeGo\HearWeGoBundle\Entity\Role $roles)
    {
        $this->roles[] = $roles;

        return $this;
    }

    /**
     * Remove roles
     *
     * @param \HearWeGo\HearWeGoBundle\Entity\Role $roles
     */
    public function removeRole(\HearWeGo\HearWeGoBundle\Entity\Role $roles)
    {
        $this->roles->removeElement($roles);
    }

    /**
     * Get roles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Add rates
     *
     * @param \HearWeGo\HearWeGoBundle\Entity\Rating $rates
     * @return User
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
     * Add orders
     *
     * @param \HearWeGo\HearWeGoBundle\Entity\Order $orders
     * @return User
     */
    public function addOrder(\HearWeGo\HearWeGoBundle\Entity\Order $orders)
    {
        $this->orders[] = $orders;

        return $this;
    }

    /**
     * Remove orders
     *
     * @param \HearWeGo\HearWeGoBundle\Entity\Order $orders
     */
    public function removeOrder(\HearWeGo\HearWeGoBundle\Entity\Order $orders)
    {
        $this->orders->removeElement($orders);
    }

    /**
     * Get orders
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOrders()
    {
        return $this->orders;
    }
}
