<?php

/**
 * Ce fichier est une partie de l'application Pablo.
 *
 * @author Michaël Perrin
 * @link http://blog.michaelperrin.fr/2013/03/19/range-date-validator-for-symfony2/
 */

namespace Pablo\PeopleBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * Class DateRange
 * @package Pablo\PeopleBundle\Validator
 *
 * @Annotation
 */
class DateRange extends Constraint
{
    public $min;
    public $max;
    public $minMessage = 'La date doit être supérieure au {{ limit }}';
    public $maxMessage = 'La date doit être inférieure au {{ limit }}';
    public $invalidMessage = 'Cette valeur n\'est pas une date valide';

    public function __construct($options = null)
    {
        parent::__construct($options);

        if (null !== $this->min) {
            $this->min = new \DateTime($this->min);
        } else {
            $minYear = date('Y') - 100;
            $this->min = \DateTime::createFromFormat('d/m/Y', '01/01/' . $minYear);
        }

        if (null !== $this->max) {
            $this->max = new \DateTime($this->max);
        } else {
            $maxYear = date('Y') - 5;
            $this->max = \DateTime::createFromFormat('d/m/Y', '31/01/' . $maxYear);
        }
    }
}