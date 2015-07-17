<?php

namespace HearWeGo\HearWeGoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Security;
use HearWeGo\HearWeGoBundle\Entity\User;
use HearWeGo\HearWeGoBundle\Form;


class UserController extends Controller
{
    /**
     * @Route("/register", name="register")
     */
    public function registerAction(){
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirect($this->generateUrl('homepage'));
        }
        $request = $this->get('request');
        $user = new User();
        $form = $this->createForm(new Form\UserRegisterType(), $user, array(
            'method' => 'POST',
            'action' => $this->generateUrl("register")
        ));
        $form->add('submit', 'submit');

        if ( $request->getMethod() == 'POST'){
            $form->handleRequest($request);
            if ($form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $roleUser = $em->getRepository('HearWeGoHearWeGoBundle:Role')->getRoleUser();
                $roleUser->addUser($user);
                $user->addRole($roleUser);
                $em->persist($roleUser);
                $em->persist($user);
                $em->flush();
                $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
                $this->get('security.token_storage')->setToken($token);
                return $this->redirect($this->generateUrl('homepage'));
            }
        }
        return $this->render('HearWeGoHearWeGoBundle:Default:register.html.twig', array(
            'form' => $form->createView()
        ));

    }

    /**
     * @Route("/login", name="user_login")
     */
    public function userLoginAction(){
        $session = $this->get('session');
        $request = $this->get('request');

        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED'))
            return $this->redirectToRoute('homepage');

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
