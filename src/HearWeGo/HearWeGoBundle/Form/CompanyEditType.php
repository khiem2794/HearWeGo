<?php

namespace HearWeGo\HearWeGoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use HearWeGo\HearWeGoBundle\Entity\Company;

class CompanyEditType extends AbstractType
{
    protected $company;

    public function __construct(Company $company)
    {
        $this->company=$company;
    }

    /**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param mixed $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name','text',array('data'=>$this->company->getName()))
            ->add('email','email',array('data'=>$this->company->getEmail()))
            ->add('phone','text',array('data'=>$this->company->getPhone()))
            ->add('address','text',array('data'=>$this->company->getAddress()))
            ->add('password','password')
            ->add('role', 'hidden', array(
                'data' => "ROLE_COMPANY"
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class'=>"HearWeGo\\HearWeGoBundle\\Entity\\Company"));
    }

    public function getName()
    {
        return 'company_edit';
    }
}