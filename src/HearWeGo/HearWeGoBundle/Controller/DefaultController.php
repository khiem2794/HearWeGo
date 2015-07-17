<?php

namespace HearWeGo\HearWeGoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use HearWeGo\HearWeGoBundle\Entity\Company;
use HearWeGo\HearWeGoBundle\Entity\User;



class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {

        $currentUser = $this->get('security.token_storage')->getToken()->getUser();
        $name = 'guest';
        if ($currentUser instanceof User) $name = $currentUser->getFirstName();
        if ($currentUser instanceof Company) $name = $currentUser->getName()." company";
        return $this->render('HearWeGoHearWeGoBundle:Default:index.html.twig', array('name' => $name));
    }

    /**
     * @Route("/test", name="test")
     */
    public function testAction(){
        $session = $this->get('session');
        return new Response("asdasdasd");
    }
}
