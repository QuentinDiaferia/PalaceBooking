<?php

namespace PB\BookingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BookingType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('start',      DateType::class)
            ->add('end',        DateType::class)
            ->add('nbHosts',    NumberType::class)
            ->add('content',    TextareaType::class)
            ->add('save',       SubmitType::class);
    }
    
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'PB\BookingBundle\Entity\Booking'
        ));
    }

    public function getBlockPrefix() {
        return 'pb_bookingbundle_booking';
    }

}
