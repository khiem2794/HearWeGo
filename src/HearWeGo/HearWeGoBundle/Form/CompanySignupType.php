<?php

namespace HearWeGo\HearWeGoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompanySignupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name','text')
            ->add('email','email')
            ->add('password','password')
            ->add('phone','text')
            ->add('address','text')
            ->add('role', 'hidden', array(
                'data' => 'ROLE_COMPANY'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class'=>"HearWeGo\HearWeGoBundle\Entity\Company"));
    }

    public function getName()
    {
        return 'hear_we_go_hear_we_go_bundle_company_signup_type';
    }
}
?>