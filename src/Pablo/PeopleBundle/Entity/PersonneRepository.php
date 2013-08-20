<?php

/**
 * Ce fichier est une partie de l'application Pablo.
 *
 * @author Thomas Decraux <thomasdecraux@gmail.com>
 * @version <0.1.0>
 */

namespace Pablo\PeopleBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * Class PersonneRepository
 * @package Pablo\PeopleBundle\Entity
 */
class PersonneRepository extends EntityRepository
{
    /**
     * Renvoie une liste paginée de personnes
     *
     * @param $limit : nombre d'éléments par page
     * @param $offset : page courante
     * @return Paginator
     * @throws \InvalidArgumentException
     */
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

    /**
     * Renvoie une liste de personnes dont les propriétés correspondent à la personne passée en paramètre :
     * le début du nom et/ou du prénom et/ou la date de naissance null ou supérieure ou égale
     * Les résultats sont limités à 50 éléments pour éviter une liste trop longue (SF2 n'aime pas)
     *
     * @param Personne $personne
     * @return array
     */
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
