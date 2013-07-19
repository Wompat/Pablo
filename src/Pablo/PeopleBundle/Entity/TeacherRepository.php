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
            ->select('t, u')
            ->leftJoin('t.user', 'u')
            ->orderBy('t.lastName')
            ->addOrderBy('t.firstName')
            ->setFirstResult(($offset - 1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
        ;

        return new Paginator($query);
    }
    
    public function search(Teacher $teacher)
    {
        $parameters = array(
            'lastName' => ($teacher->getLastName() !== null) ? $teacher->getLastName() . '%' : '%',
            'firstName' => ($teacher->getFirstName() !== null) ? $teacher->getFirstName() . '%' : '%',
            'dateOfBirth' => ($teacher->getDateOfBirth() !== null) ? $teacher->getDateOfBirth() : '',
        );

        $qb = $this->createQueryBuilder('t');

        $query = $qb
            ->where($qb->expr()->like('t.lastName', ':lastName'))
            ->andWhere($qb->expr()->like('t.firstName', ':firstName'))
            ->andWhere($qb->expr()->gte('t.dateOfBirth', ':dateOfBirth'))
            ->orderBy('t.lastName')
            ->addOrderBy('t.firstName')
            ->setParameters($parameters)
            ->setMaxResults(50)
            ->getQuery()
        ;

        return $query->getResult();
    }
}
