<?php

namespace Pablo\OrganisationBundle\Entity;

use Doctrine\ORM\EntityRepository;

class CourseRepository extends EntityRepository
{
    public function getSpecialties()
    {
        $qb = $this->createQueryBuilder('s');

//        $qb->select('s, i.id')
//            ->innerJoin('s.parent', 'i')
        $qb->where($qb->expr()->isNotNull('s.parent'))
            ->andWhere('s.domain = 4')
            ->orderBy('s.title')
        ;

        return $qb->getQuery()->getResult();
    }
}
