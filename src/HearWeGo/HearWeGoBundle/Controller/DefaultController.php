<?php

namespace HearWeGo\HearWeGoBundle\Controller;

use Doctrine\ORM\NoResultException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Console\Helper\Helper;
use Symfony\Component\HttpFoundation\Response;
use HearWeGo\HearWeGoBundle\Entity\Company;
use HearWeGo\HearWeGoBundle\Entity\User;
use HearWeGo\HearWeGoBundle\Entity\Article;


class DefaultController extends Controller
{
    public function filerHot($array)
    {
        if (count($array) == 0) return array();
        $array_filter = array();
        $count = 0;
        $filter_ele = 0;
        while ($count < count($array)) {

            $array_filter[$filter_ele] = array();
            $array_filter[$filter_ele][] = $array[$count];
            if ($count + 1 < count($array))
                $array_filter[$filter_ele][] = $array[$count + 1];
            else break;
            $filter_ele++;
            $count += 2;
        }
        return $array_filter;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        /**
         * Hot Places Block
         */
        $audiorepo = $em->getRepository('HearWeGoHearWeGoBundle:Audio');
        $hotaudio = $audiorepo->findHotAudio(10);
        $hotplaces = array();
        foreach ($hotaudio as $audio) {
            $place = array();
            $destination = $audio->getDestination();
            $photos = $destination->getPhotos()->toArray();
            $place[0] = $destination->getName();
            $place[1] = (count($photos) > 0) ? $photos[array_rand($photos)]->getWebPath() : "";
            $place[2] = $this->generateUrl('detail', array(
                "id" => $destination->getID()
            ));
            $hotplaces[] = $place;
        }
        $hotplaces_filter = $this->filerHot($hotplaces);
        /**
         * New Tours Block
         */
        $toursrepo = $em->getRepository('HearWeGoHearWeGoBundle:Tour');
        $newTours = $toursrepo->findNewTour(16);
        $newtoursfilter = $this->filerHot($newTours);
        return $this->render('HearWeGoHearWeGoBundle:Default/HomePage:homepage.html.twig', array(
            'hotplaces_filter' => $hotplaces_filter,
            'newtourfilter' => $newtoursfilter
        ));
    }

    /**
     * @Route("/destination",name="destination")
     */
    public function destinationAction()
    {
        return $this->render('HearWeGoHearWeGoBundle:Default/Destination:destination.html.twig', array());
    }

    /**
     * @Route("/destination/{id} ", name="detail")
     */
    public function detailAction($id)
    {

        $request = $this->get('request');
        $session = $this->get('session');

        $em = $this->getDoctrine()->getManager();
        $destinationrepo = $em->getRepository('HearWeGoHearWeGoBundle:Destination');

        $destination = $destinationrepo->find($id);

        if ($destination == NULL)
            return $this->redirect($this->generateUrl('destination'));
        else {
            $photos = $destination->getPhotos();
            $tours = $destination->getTours();
            return $this->render('HearWeGoHearWeGoBundle:Default/Detail:detail.html.twig', array(
                'destination' => $destination,
                'photos' => $photos->toArray(),
                'tours' => $tours->toArray()
            ));
        }

    }

    /**
     * @Route("/blog", name="blog")
     */
    public function blogAction()
    {
        return $this->render('HearWeGoHearWeGoBundle:Default/Blog:blog.html.twig');
    }

    /**
     * @Route("/blog/{id}", name="article")
     */
    public function articleAction($id)
    {
        return $this->render('HearWeGoHearWeGoBundle:Default/Article:article.html.twig');
    }

    /**
     * @Route("/map", name="map")
     */
    public function mapAction()
    {
        return $this->render('HearWeGoHearWeGoBundle:Default/Map:map.html.twig');
    }

    /**
     * @Route("/test", name="test")
     */
    public function testAction()
    {
        return $this->render('HearWeGoHearWeGoBundle::test.html.twig');
    }
}
