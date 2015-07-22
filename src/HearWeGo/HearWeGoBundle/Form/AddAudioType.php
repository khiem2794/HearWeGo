<?php

namespace HearWeGo\HearWeGoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use HearWeGo\HearWeGoBundle\Entity\Audio;

class AddAudioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $destination_repo=$options['dr'];

        $builder
            ->add('name','text')
            ->add('audio','file')
            ->add('destination','entity',array(
                'class'=>'HearWeGoHearWeGoBundle:Destination',
                'choices'=>$destination_repo->findDestinationWithoutAudio(),
                'property'=>'name'
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class'=>"HearWeGo\\HearWeGoBundle\\Entity\\Audio"));
        $resolver->setRequired(array('dr'));
    }

    public function getName()
    {
        return 'add_audio';
    }

}