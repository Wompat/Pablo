<?php

namespace Pablo\PeopleBundle\Entity;

use Doctrine\ORM\EntityRepository;

class LocaliteRepository extends EntityRepository
{
    public function getCodesEtNoms()
    {
        $qb = $this->createQueryBuilder('l');

        $qb
            ->select($qb->expr()->concat('l.codepostal', $qb->expr()->concat('\' \'', 'l.nom')))
            ->orderBy('l.codepostal')
            ->addOrderBy('l.nom')
        ;

        return $qb->getQuery()->getResult();
    }
}
