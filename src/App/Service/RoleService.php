<?php


namespace App\Service;


use App\Entity\Role;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;

class RoleService
{

    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function findAll(){
        return $this->em->getRepository(Role::class)->findAll();
    }

    public function find($id){
        return $this->em->getRepository(Role::class)->find($id);
    }

    public function save(Role $role){

        $id = (int) $role->getId();

        if($id > 0){
            $roleFind = $this->em->getRepository(Role::class)->find(0);

            if($roleFind != null){
                $roleFind->hydrate($role);
                $this->em->persist($roleFind);
                $this->em->flush();
            }
        }else{

            $this->em->persist($role);
            $this->em->flush();
        }


    }

    public function remove($id){
        $role = $this->em->getReference(Role::class, $id);

        if($role != null){
            $this->em->remove($role);
            $this->em->flush();
        }
    }

}