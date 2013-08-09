<?php

namespace Pablo\PeopleBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class EmployeRepository extends EntityRepository
{
    public function getListePaginee($limit, $offset)
    {
        if ($offset < 1) {
            throw new \InvalidArgumentException('Le numéro de la page ne peut être inférieur à 1.');
        }

        $query = $this->createQueryBuilder('e')
            ->select('e, u')
            ->leftJoin('e.user', 'u')
            ->orderBy('e.nom')
            ->addOrderBy('e.prenom')
            ->setFirstResult(($offset - 1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
        ;

        return new Paginator($query);
    }

    public function search(Employe $teacher)
    {
        $parameters = array(
            'nom' => ($teacher->getNom() !== null) ? $teacher->getNom() . '%' : '%',
            'prenom' => ($teacher->getPrenom() !== null) ? $teacher->getPrenom() . '%' : '%',
            'datenaissance' => ($teacher->getDatenaissance() !== null) ? $teacher->getDatenaissance() : '',
        );

        $qb = $this->createQueryBuilder('e');

        $query = $qb
            ->where($qb->expr()->like('e.nom', ':nom'))
            ->andWhere($qb->expr()->like('e.prenom', ':prenom'))
            ->andWhere($qb->expr()->orX(
                $qb->expr()->gte('e.datenaissance', ':datenaissance'),
                $qb->expr()->isNull('e.datenaissance')
            ))
            ->orderBy('e.nom')
            ->addOrderBy('e.prenom')
            ->setParameters($parameters)
            ->setMaxResults(50)
            ->getQuery()
        ;

        return $query->getResult();
    }
}
