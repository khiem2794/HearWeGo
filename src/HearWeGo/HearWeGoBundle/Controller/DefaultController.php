<?php

namespace HearWeGo\HearWeGoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $currentUser = $this->get('security.token_storage')->getToken()->getUser();
        $name = (!$currentUser)?'guest':$currentUser->getEmail();
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
