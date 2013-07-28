<?php

namespace Pablo\PeopleBundle\Entity;

use Doctrine\ORM\EntityRepository;

class PaysRepository extends EntityRepository
{
    public function getNoms()
    {
        $qb = $this->createQueryBuilder('p')
            ->select('p.nom')
            ->orderBy('p.nom')
            ->getQuery()
        ;

        return $qb->getResult();
    }
}