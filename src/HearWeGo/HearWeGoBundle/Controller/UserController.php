<?php

namespace HearWeGo\HearWeGoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\Security;
use HearWeGo\HearWeGoBundle\Entity\User;
use HearWeGo\HearWeGoBundle\Form;


class UserController extends Controller
{
    /**
     * @Route("/login", name="user_login")
     */
    public function userLoginAction(){
        $session = $this->get('session');
        $request = $this->get('request');

        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED'))
            return $this->redirectToRoute('admin_index');

        if ( $request->attributes->has(Security::AUTHENTICATION_ERROR)){
            $error = $request->attributes->has(Security::AUTHENTICATION_ERROR);
        }
        else {
            $error = $session->get(Security::AUTHENTICATION_ERROR);
            $session->remove(Security::AUTHENTICATION_ERROR);
        }

        $admin = new User();
        $form = $this->createForm(new Form\UserLoginType(), $admin, array(
            'method' => 'POST',
            'action' => $this->generateUrl('user_login_check')
        ));
        $form->add('submit', 'submit');
        return $this->render('HearWeGoHearWeGoBundle:Default:login.html.twig', array(
            'form' => $form->createView(),
            'error' => $error
        ));


    }

    /**
     * @Route("/login_check", name="user_login_check")
     */
    public function userLoginCheckAction(){

    }

    /**
     * @Route("/logout", name="user_logout")
     */
    public function userLogoutAction(){

    }


}
