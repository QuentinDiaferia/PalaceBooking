<?php
// src/PB/BookingBundle/Validator/PalaceFullValidator.php

namespace PB\BookingBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class PalaceFullValidator extends ConstraintValidator {

	public function validate($value, Constraint $constraint) {

		if (false) {
			$this->context
			  ->buildViolation($constraint->message)
			  ->setParameters(array('%string%' => $value))
			  ->addViolation();
		}

	}

}