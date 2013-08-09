<?php

namespace Pablo\PeopleBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * Class PhoneNumber
 * @package Pablo\PeopleBundle\Validator
 *
 * @Annotation
 */
class PhoneNumber extends Constraint
{
    public $min = 0;
    public $max = 255;
    public $minMessage = 'Le numéro de téléphone doit avoir au moins {{ limit }} chiffres.';
    public $maxMessage = 'Le numéro de téléphone doit avoir au plus {{ limit }} chiffres.';
    public $invalidMessage = 'Cette valeur n\'est pas valide.';
}