<?php

namespace HearWeGo\HearWeGoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('content');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HearWeGo\HearWeGoBundle\Entity\Comment'
        ));
    }

    public function getName()
    {
        return 'hear_we_go_hear_we_go_bundle_comment_type';
    }
}
