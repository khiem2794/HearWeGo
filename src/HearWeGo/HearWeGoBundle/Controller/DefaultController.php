<?php

namespace HearWeGo\HearWeGoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="hello")
     */
    public function indexAction()
    {
        return $this->render('HearWeGoHearWeGoBundle:Default:index.html.twig', array('name' => 'guest'));
    }

    /**
     * @Route("/test", name="test")
     */
    public function testAction(){
        $session = $this->get('session');
        return new Response("asdasdasd");
    }
}
