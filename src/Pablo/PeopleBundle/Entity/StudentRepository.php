<?php

namespace Pablo\PeopleBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class StudentRepository extends EntityRepository
{
    public function getPagedList($limit, $offset)
    {
        if ($offset < 1) {
            throw new \InvalidArgumentException('Le numéro de la page ne peut être inférieur à 1.');
        }

        $query = $this->createQueryBuilder('s')
            ->orderBy('s.lastName')
            ->addOrderBy('s.firstName')
            ->setFirstResult(($offset - 1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
        ;

        return new Paginator($query);
    }

    public function getByName($lastName, $firstName)
    {
        $qb = $this->createQueryBuilder('s');

        $query = $qb
            ->where($qb->expr()->like('s.lastName', ':lastName'))
            ->andWhere($qb->expr()->like('s.firstName', ':firstName'))
            ->orderBy('s.lastName')
            ->addOrderBy('s.firstName')
            ->setParameters(array(
                'lastName' => $lastName . '%', 'firstName' => $firstName . '%'
            ))
            ->setMaxResults(50)
            ->getQuery()
        ;

        return $query->getResult();
    }
}