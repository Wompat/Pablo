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

    public function search(Student $student)
    {
        $parameters = array(
            'lastName' => ($student->getLastName() !== null) ? $student->getLastName() . '%' : '%',
            'firstName' => ($student->getFirstName() !== null) ? $student->getFirstName() . '%' : '%',
            'dateOfBirth' => ($student->getDateOfBirth() !== null) ? $student->getDateOfBirth() : '',
        );

        $qb = $this->createQueryBuilder('s');

        $query = $qb
            ->where($qb->expr()->like('s.lastName', ':lastName'))
            ->andWhere($qb->expr()->like('s.firstName', ':firstName'))
            ->andWhere($qb->expr()->gte('s.dateOfBirth', ':dateOfBirth'))
            ->orderBy('s.lastName')
            ->addOrderBy('s.firstName')
            ->setParameters($parameters)
            ->setMaxResults(50)
            ->getQuery()
        ;

        return $query->getResult();
    }
}