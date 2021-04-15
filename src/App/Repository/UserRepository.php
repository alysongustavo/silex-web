<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{

    public function findUserWithAddress($id){

        $queryBuilder = $this->createQueryBuilder();
        $queryBuilder->select(['u', 'a'])
                ->from('Address', 'a')
                ->innerJoin('a.user', 'u')
                ->setParameter('u.id', $id);

        $query = $queryBuilder->getQuery();
        $results = $query->getResult();

        return $results;
    }

}