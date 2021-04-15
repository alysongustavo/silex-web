<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Laminas\Hydrator\ClassMethodsHydrator;

/**
 * Class Role
 * @package App\Entity
 * @ORM\Entity()
 * @ORM\Table(name="role")
 */
class Role
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
     * @ORM\Column(name="name", type="string", length=60, nullable=false)
     */
    private $name;

    /**
     * Role constructor.
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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Role
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
     * @return Role
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }


}