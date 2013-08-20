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
 * Class EmployeRepository
 * @package Pablo\PeopleBundle\Entity
 */
class EmployeRepository extends EntityRepository
{
    /**
     * Renvoie une liste paginée d'employés
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

    /**
     * Renvoie une liste d'employés dont les propriétés correspondent à l'employé passé en paramètre :
     * le début du nom et/ou du prénom et/ou la date de naissance null ou supérieure ou égale
     * Les résultats sont limités à 50 éléments pour éviter une liste trop longue (SF2 n'aime pas)
     *
     * @param Employe $teacher
     * @return array
     */
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
