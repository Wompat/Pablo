<?php

namespace Pablo\PeopleBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class TeacherRepository extends EntityRepository
{
    public function getPagedList($limit, $offset)
    {
        if ($offset < 1) {
            throw new \InvalidArgumentException('Le numéro de la page ne peut être inférieur à 1.');
        }

        $query = $this->createQueryBuilder('t')
            ->orderBy('t.lastName')
            ->addOrderBy('t.firstName')
            ->setFirstResult(($offset - 1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
        ;

        return new Paginator($query);
    }
    
    public function getByName($lastName, $firstName)
    {
        $qb = $this->createQueryBuilder('t');

        $query = $qb
            ->where($qb->expr()->like('t.lastName', ':lastName'))
            ->andWhere($qb->expr()->like('t.firstName', ':firstName'))
            ->orderBy('t.lastName')
            ->addOrderBy('t.firstName')
            ->setParameters(array(
                'lastName' => $lastName . '%', 'firstName' => $firstName . '%'
            ))
            ->setMaxResults(100)
            ->getQuery()
        ;

        return $query->getResult();
    }
}
