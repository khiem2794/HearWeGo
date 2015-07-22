<?php

namespace HearWeGo\HearWeGoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GalleryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('img', 'file', array(
                    'attr' => array(
                        'accept' => 'image/*',
                        'multiple' => 'multiple'
                    )
                ))
                ->add('destination', 'entity', array(
                    'class' => 'HearWeGo\HearWeGoBundle\Entity\Destination',
                    'property' => 'name'

                ))
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => "HearWeGo\\HearWeGoBundle\\Entity\\Gallery"
        ));
    }

    public function getName()
    {
        return 'gallery_type';
    }
}
