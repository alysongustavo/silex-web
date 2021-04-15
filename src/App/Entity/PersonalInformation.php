<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Laminas\Hydrator\ClassMethodsHydrator;

/**
 * Class PersonalInformation
 * @package App\Entity
 * @ORM\Entity()
 * @ORM\Table(name="personal_information")
 */
class PersonalInformation
{

    /**
     * @var integer
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var User
     * @ORM\OneToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var string
     * @ORM\Column(name="cpf", type="string", length=20, nullable=false)
     */
    private $cpf;

    /**
     * @var string
     * @ORM\Column(name="rg", type="string", length=20, nullable=false)
     */
    private $rg;

    /**
     * PersonalInformation constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $hydrator = new ClassMethodsHydrator();
        $hydrator->hydrate($data, $this);
    }

    public function toArray(){
        return (new ClassMethodsHydrator())->extract($this);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return PersonalInformation
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return PersonalInformation
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @param mixed $cpf
     * @return PersonalInformation
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRg()
    {
        return $this->rg;
    }

    /**
     * @param mixed $rg
     * @return PersonalInformation
     */
    public function setRg($rg)
    {
        $this->rg = $rg;
        return $this;
    }


}