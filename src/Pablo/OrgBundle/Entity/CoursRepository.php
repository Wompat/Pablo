<?php

namespace Pablo\OrgBundle\Entity;

use Doctrine\ORM\EntityRepository;

class CoursRepository extends EntityRepository
{
    public function getSpecialites()
    {
        $qb = $this->createQueryBuilder('s');

//        $qb->select('s, i.id')
//            ->innerJoin('s.parent', 'i')
        $qb->where($qb->expr()->isNotNull('s.intitule'))
            ->andWhere('s.domaine = 4')
            ->orderBy('s.libelle')
        ;

        return $qb->getQuery()->getResult();
    }
}
