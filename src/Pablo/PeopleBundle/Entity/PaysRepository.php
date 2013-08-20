<?php

/**
 * Ce fichier est une partie de l'application Pablo.
 *
 * @author Thomas Decraux <thomasdecraux@gmail.com>
 * @version <0.1.0>
 */

namespace Pablo\PeopleBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Ce fichier est une partie de l'application Pablo.
 *
 * @author Thomas Decraux <thomasdecraux@gmail.com>
 * @version <0.1.0>
 */
class PaysRepository extends EntityRepository
{
    /**
     * Renvoie la liste des noms des pays
     * @return array
     */
    public function getNoms()
    {
        $qb = $this->createQueryBuilder('p')
            ->select('p.nom')
            ->orderBy('p.nom')
            ->getQuery()
        ;

        return $qb->getResult();
    }
}