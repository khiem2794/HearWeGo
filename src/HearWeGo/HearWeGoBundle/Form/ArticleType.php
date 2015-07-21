<?php

namespace HearWeGo\HearWeGoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title')
                ->add('imgpath', 'file')
                ->add('content', 'textarea')
                ->add('tags', 'tag_type');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HearWeGo\\HearWeGoBundle\\Entity\\Article'
        ));
    }

    public function getName()
    {
        return 'article_type';
    }
}
