<?php

namespace HearWeGo\HearWeGoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserRegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email', 'text')
                ->add('firstName', 'text')
                ->add('lastName', 'text')
                ->add('dateOfBirth', 'date', array(
                    'years' => range(date('Y') -100, date('Y')-5)
                ))
                ->add('phone', 'text')
                ->add('password', 'password');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HearWeGo\\HearWeGoBundle\\Entity\\User'
        ));
    }

    public function getName()
    {
        return 'user_register_type';
    }
}
