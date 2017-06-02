<?php

namespace Dem3trio\CarbonProfilerBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class TravelFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $now = new \DateTime();
        $builder->add('date', 'Symfony\Component\Form\Extension\Core\Type\DateTimeType', array('data' => $now));
        $builder->add('submit', 'Symfony\Component\Form\Extension\Core\Type\SubmitType' );
        return $builder;
    }
}