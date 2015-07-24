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
        return $this->render('HearWeGoHearWeGoBundle:Default/HomePage:homepage.html.twig', array('name' => $name));
    }

    /**
     * @Route("/destination",name="destination")
     */
    public function destinationAction()
    {
        return $this->render('HearWeGoHearWeGoBundle:Default/Destination:destination.html.twig',array());
    }

    /**
     * @Route("/detail", name="detail")
     */
    public function detailAction(){
        return $this->render('HearWeGoHearWeGoBundle:Default/Detail:detail.html.twig');

    }


    /**
     * @Route("/blog", name="blog")
     */
    public function Action(){
        return $this->render('HearWeGoHearWeGoBundle:Default/HandBook:articles.html.twig');
    }

    /**
     * @Route("/blog/{id}", name="article")
     */
    public function articleAction( $id ){
        return $this->render('HearWeGoHearWeGoBundle:Default/HandBook:article.html.twig');
    }

}
