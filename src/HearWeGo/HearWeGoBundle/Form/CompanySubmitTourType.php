<?php

namespace HearWeGo\HearWeGoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompanySubmitTourType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name','text')
            ->add('startdate','datetime')
            ->add('enddate','datetime')
            ->add('discount','number')
            ->add('info','text')
            ->add('destinations','checkbox')
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class'=>"HearWeGo\HearWeGoBundle\Entity\Tour"));
    }

    public function getName()
    {
        return 'company_submit_tour';
    }
}
