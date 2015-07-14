<?php

namespace HearWeGo\HearWeGoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}", name="hello")
     */
    public function indexAction($name)
    {
        return $this->render('HearWeGoHearWeGoBundle:Default:index.html.twig', array('name' => $name));
    }
}
