<?php

namespace App\Repository;

use App\Entity\Address;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr;

class UserRepository extends EntityRepository
{

    public function findAllUserAggregate($id){

        $users = $this->getEntityManager()->createQuery('SELECT u, a, p, r FROM App\Entity\User u
                INNER JOIN u.address a
                INNER JOIN u.personalInformation p
                INNER JOIN u.roles r
                WHERE u.id = ?1
                ORDER BY u.id');
        $users->setParameter(1, $id);
        $results = $users->getResult();


        return $results;
    }

}