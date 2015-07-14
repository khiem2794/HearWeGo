<?php


namespace HearWeGo\HearWeGoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="HearWeGo\HearWeGoBundle\Entity\Repository\RoleRepository")
 * @ORM\Table(name="role")
 */
class Role
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $role;

    /**
     * @ORM\ManyToMany(targetEntity="HearWeGo\HearWeGoBundle\Entity\User", inversedBy="roles")
     * @ORM\JoinTable(name="users_roles")
     */
    private $users;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
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
     * Set role
     *
     * @param string $role
     * @return Role
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string 
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Add users
     *
     * @param \HearWeGo\HearWeGoBundle\Entity\User $users
     * @return Role
     */
    public function addUser(\HearWeGo\HearWeGoBundle\Entity\User $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \HearWeGo\HearWeGoBundle\Entity\User $users
     */
    public function removeUser(\HearWeGo\HearWeGoBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }
}
