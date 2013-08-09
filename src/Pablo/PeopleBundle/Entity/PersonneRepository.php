<?php

namespace Pablo\PeopleBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class PersonneRepository extends EntityRepository
{
    public function getListePaginee($limit, $offset)
    {
        if ($offset < 1) {
            throw new \InvalidArgumentException('Le numéro de la page ne peut être inférieur à 1.');
        }

        $query = $this->createQueryBuilder('p')
            ->orderBy('p.nom')
            ->addOrderBy('p.prenom')
            ->setFirstResult(($offset - 1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
        ;

        return new Paginator($query);
    }

    public function search(Personne $personne)
    {
        $parameters = array(
            'nom' => ($personne->getNom() !== null) ? $personne->getNom() . '%' : '%',
            'prenom' => ($personne->getPrenom() !== null) ? $personne->getPrenom() . '%' : '%',
            'datenaissance' => ($personne->getDatenaissance() !== null) ? $personne->getDatenaissance() : '',
        );

        $qb = $this->createQueryBuilder('p');

        $query = $qb
            ->where($qb->expr()->like('p.nom', ':nom'))
            ->andWhere($qb->expr()->like('p.prenom', ':prenom'))
            ->andWhere($qb->expr()->orX(
                $qb->expr()->gte('p.datenaissance', ':datenaissance'),
                $qb->expr()->isNull('p.datenaissance')
            ))
            ->orderBy('p.nom')
            ->addOrderBy('p.prenom')
            ->setParameters($parameters)
            ->setMaxResults(50)
            ->getQuery()
        ;

        return $query->getResult();
    }
}
