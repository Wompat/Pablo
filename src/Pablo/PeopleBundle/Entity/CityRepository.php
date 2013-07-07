<?php

namespace Pablo\PeopleBundle\Entity;

use Doctrine\ORM\EntityRepository;

class CityRepository extends EntityRepository
{
    public function getCodesAndNames()
    {
        $qb = $this->createQueryBuilder('c');

        $qb
            ->select($qb->expr()->concat('c.postalCode', $qb->expr()->concat('\' \'', 'c.name')))
            ->orderBy('c.postalCode')
            ->addOrderBy('c.name')
        ;

        return $qb->getQuery()->getResult();
    }
}
