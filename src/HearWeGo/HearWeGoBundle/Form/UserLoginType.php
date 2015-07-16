<?php

namespace HearWeGo\HearWeGoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserLoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email', 'text')
                ->add('password', 'password');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
    $resolver->setDefaults(array(
        'data_class' => 'HearWeGo\HearWeGoBundle\Entity\User'
    ));
    }

    public function getName()
    {
        return 'user_login_type';
    }
}
