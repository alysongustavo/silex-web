<?php


namespace App\Service;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;

class UserService
{

    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function findAll(){
        $users = $this->em->getRepository(User::class)->findAll();

        return $users;
    }

    public function findUserAggregate($id){
        $users = $this->em->getRepository(User::class)->findAllUserAggregate($id);

        return $users;
    }

    public function find($id){
        return $this->em->getRepository(User::class)->find($id);
    }

    public function findUserWithAddress($id){

        $chave = (int) $id;

        if($chave > 0){
            return $this->em->getRepository(User::class)->findUserWithAddress($id);
        }else{
            throw new EntityNotFoundException('Usuario não encontrado');
        }

    }

    public function save(User $user){

        $id = (int) $user->getId();

        if($id > 0){
            $userFind = $this->em->getRepository(User::class)->find(0);

            if($userFind != null){
                $userFind->hydrate($user);
                $this->em->persist($userFind);
                $this->em->flush();
                return $userFind;
            }
        }else{

            $this->em->persist($user);
            $this->em->flush();
            return $user;
        }


    }

    public function remove($id){
        $user = $this->em->getReference(User::class, $id);

        if($user != null){
            $this->em->remove($user);
            $this->em->flush();
        }
    }

}