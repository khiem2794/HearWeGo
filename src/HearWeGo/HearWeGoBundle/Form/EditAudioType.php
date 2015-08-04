<?php

namespace HearWeGo\HearWeGoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use HearWeGo\HearWeGoBundle\Entity\Audio;

class EditAudioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name','text')
            ->add('audio','file');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class'=>"HearWeGo\\HearWeGoBundle\\Entity\\Audio"));
    }

    public function getName()
    {
        return 'add_audio';
    }

}
?>