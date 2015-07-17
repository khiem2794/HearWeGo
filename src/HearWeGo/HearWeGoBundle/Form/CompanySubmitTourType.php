<?php

namespace HearWeGo\HearWeGoBundle\Form;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;
use HearWeGo\HearWeGoBundle\Util\DestinationUtil;
use Doctrine\ORM\EntityRepository;
use HearWeGo\HearWeGoBundle\Form\Transformer\DestinationTransformer;

class CompanySubmitTourType extends AbstractType
{
    protected $desService;
    protected $destinationTransformer;

    public function __construct(DestinationTransformer $destinationTransformer)
    {
        //$this->desService = $destinationUtil;
        $this->destinationTransformer = $destinationTransformer;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('name','text')
            ->add('startdate','datetime')
            ->add('enddate','datetime')
            ->add('discount','number')
            ->add('info','text')
            ->add('destination', 'text', array(
                'invalid_message' => 'not a valid destination'
            ))
            ;
        $builder->get('destination')
            ->addModelTransformer($this->destinationTransformer);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class'=>'HearWeGo\HearWeGoBundle\Entity\Tour'));
    }

    public function getName()
    {
        return 'company_submit_tour';
    }
}
