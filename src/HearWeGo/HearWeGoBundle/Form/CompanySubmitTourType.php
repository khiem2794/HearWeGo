<?php

namespace HearWeGo\HearWeGoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use HearWeGo\HearWeGoBundle\Form\Transformer\DestinationTransformer;
use Symfony\Component\Validator\Constraints\Date;

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
        $date = new \DateTime();
        $builder
            ->add('name','text')
            ->add('startdate','date', array(
                'years' => range(date('Y'), date('Y')+1),
                'data' => new \DateTime()
            ))
            ->add('enddate','date', array(
                'years' => range(date('Y'), date('Y')+1),
                'data' => new \DateTime()
            ))
            ->add('discount','number')
            ->add('info','textarea', array(
                'label' => 'Tour information'
            ))
            ->add('destination', 'entity', array(
                'class'=>'HearWeGoHearWeGoBundle:Destination',
                'property'=>'name',
                'required' => true
            ))
            ;

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
