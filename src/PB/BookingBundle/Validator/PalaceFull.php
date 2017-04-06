<?php
// src/PB/BookingBundle/Validator/PalaceFull.php

namespace PB\BookingBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class PalaceFull extends Constraint
{
	public $message = "Le Palace est complet la nuit du %string%.";
}