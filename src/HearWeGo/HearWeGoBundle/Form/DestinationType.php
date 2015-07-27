<?php

namespace HearWeGo\HearWeGoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DestinationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name')
                ->add('region' , 'entity', array(
                    'class' => 'HearWeGoHearWeGoBundle:Region',
                    'property' => 'name',
                    'required' => true
                ))
                ->add('location')
                ->add('article', 'textarea')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => "HearWeGo\\HearWeGoBundle\\Entity\\Destination"
        ));
    }

    public function getName()
    {
        return 'destination_type';
    }
}
