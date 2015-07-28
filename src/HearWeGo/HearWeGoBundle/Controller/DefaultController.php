<?php

namespace HearWeGo\HearWeGoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Console\Helper\Helper;
use Symfony\Component\HttpFoundation\Response;
use HearWeGo\HearWeGoBundle\Entity\Company;
use HearWeGo\HearWeGoBundle\Entity\User;
use HearWeGo\HearWeGoBundle\Entity\Article;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        $articlerepo = $em->getRepository('HearWeGoHearWeGoBundle:Article');
        $topnews = $articlerepo->findLimit(8);
        //return $this->render('HearWeGoHearWeGoBundle::test.html.twig');
        return $this->render('HearWeGoHearWeGoBundle:Default/HomePage:homepage.html.twig', array(
            'topnews' => $topnews
        ));
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
        return $this->render('HearWeGoHearWeGoBundle:Default/Blog:blog.html.twig');
    }

    /**
     * @Route("/blog/{id}", name="article")
     */
    public function articleAction( $id ){
        return $this->render('HearWeGoHearWeGoBundle:Default/Article:article.html.twig');
    }

    /**
     * @Route("/map", name="map")
     */
    public function mapAction(){
        return $this->render('HearWeGoHearWeGoBundle:Default/Map:map.html.twig');
    }

}
