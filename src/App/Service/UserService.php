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
        return $this->em->getRepository(User::class)->findAll();
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

}