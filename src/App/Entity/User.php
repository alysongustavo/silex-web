<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Laminas\Hydrator\ClassMethodsHydrator;

/**
 * Class User
 * @package App\Entity
 *
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="user")
 *
 */
class User
{

    /**
     * @var integer
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="email", type="string", length=100, nullable=false)
     */
    private $email;

    /**
     * @var string
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * One Customer has One Cart.
     * @ORM\OneToMany(targetEntity="App\Entity\Address", mappedBy="user", cascade={"persist"})
     */
    private $address;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="App\Entity\Role")
     * @ORM\JoinTable(name="user_role",
     *     joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")})
     */
    private $roles;

    /**
     * One Customer has One Cart.
     * @ORM\OneToOne(targetEntity="App\Entity\PersonalInformation", mappedBy="user", cascade={"persist"})
     */
    private $personalInformation;

    public function __construct(array $data)
    {
        $this->roles = new ArrayCollection();
        $this->address = new ArrayCollection();

        $hydrator = new ClassMethodsHydrator();
        $hydrator->hydrate($data, $this);
    }

    public function hydrate(User $user){
        $hydratorObject = new ClassMethodsHydrator();
        return $hydratorObject->hydrate($user->toArray(), $this);
    }

    public function toArray(){
        return (new ClassMethodsHydrator())->extract($this);
    }

    /**
     * @return mixed
     *
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param ArrayCollection $roles
     * @return User
     */
    public function addAddress($endereco)
    {
        $this->address->add($endereco);
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param ArrayCollection $roles
     * @return User
     */
    public function addRole($role)
    {
        $this->roles->add($role);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPersonalInformation()
    {
        return $this->personalInformation;
    }

    /**
     * @param mixed $personalInformation
     * @return User
     */
    public function setPersonalInformation($personalInformation)
    {
        $this->personalInformation = $personalInformation;
        return $this;
    }

}