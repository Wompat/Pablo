<?php

namespace Pablo\PeopleBundle\Entity;

use Doctrine\ORM\EntityRepository;

class CountryRepository extends EntityRepository
{
    public function getNames()
    {
        $qb = $this->createQueryBuilder('c')
            ->select('c.name')
            ->orderBy('c.name')
            ->getQuery()
        ;

        return $qb->getResult();
    }
}