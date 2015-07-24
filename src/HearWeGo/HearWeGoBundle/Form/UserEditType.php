<?php

namespace HearWeGo\HearWeGoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use HearWeGo\HearWeGoBundle\Entity\User;

class UserEditType extends AbstractType
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user=$user;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName','text',array('data'=>$this->user->getFirstName()))
            ->add('lastName','text',array('data'=>$this->user->getLastName()))
            ->add('email','email',array('data'=>$this->user->getEmail()))
            ->add('dateOfBirth','date',array(
                'data'=>$this->user->getDateOfBirth(),
                'years' => range(date('Y') -100, date('Y')-5)))
            ->add('phone','text',array('data'=>$this->user->getPhone()))
            ->add('password','password')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults(array('data_class'=>"HearWeGo\\HearWeGoBundle\\Entity\\User"));

    }

    public function getName()
    {
        return 'user_edit';
    }



}
?>
