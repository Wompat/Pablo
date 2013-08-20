<?php

/**
 * Ce fichier est une partie de l'application Pablo.
 *
 * @author Thomas Decraux <thomasdecraux@gmail.com>
 * @version <0.1.0>
 */

namespace Pablo\PeopleBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class PhoneNumberValidator
 * @package Pablo\PeopleBundle\Validator
 */
class PhoneNumberValidator extends ConstraintValidator
{
    /**
     * Checks if the passed value is valid.
     *
     * @param mixed $value      The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     *
     * @api
     */
    public function validate($value, Constraint $constraint)
    {
        if (null === $value) {
            return;
        }

        $number = preg_replace('`[^0-9]`', '', $value);

        if (null !== $constraint->min && strlen($number) < $constraint->min) {
            $this->context->addViolation($constraint->minMessage, array(
                '{{ value }}' => $number,
                '{{ limit }}' => $constraint->min,
            ));
        }

        if (null !== $constraint->max && strlen($number) > $constraint->max) {
            $this->context->addViolation($constraint->maxMessage, array(
                '{{ value }}' => $number,
                '{{ limit }}' => $constraint->max,
            ));
        }
    }
}