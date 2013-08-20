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
 * Class LocaliteRepository
 * @package Pablo\PeopleBundle\Entity
 */
class LocaliteRepository extends EntityRepository
{
    /**
     * Renvoie la liste avec le code postal et le nom de chaque localité
     *
     * @return array
     */
    public function getCodesEtNoms()
    {
        $qb = $this->createQueryBuilder('l');

        $qb
            ->select($qb->expr()->concat('l.codepostal', $qb->expr()->concat('\' \'', 'l.nom')))
            ->orderBy('l.codepostal')
            ->addOrderBy('l.nom')
        ;

        return $qb->getQuery()->getResult();
    }
}
