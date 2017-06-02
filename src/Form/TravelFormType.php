<?php

namespace Dem3trio\Bundle\CarbonProfilerBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TravelFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $now = new \DateTime();
        $builder->add('date', 'Symfony\Component\Form\Extension\Core\Type\DateTimeType', array('data' => $now));
        $builder->add('submit', 'Symfony\Component\Form\Extension\Core\Type\SubmitType' );
        return $builder;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection' => false,
        ));
    }
}