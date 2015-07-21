<?php

namespace HearWeGo\HearWeGoBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use HearWeGo\HearWeGoBundle\Entity\User;
use HearWeGo\HearWeGoBundle\Entity\Article;
use HearWeGo\HearWeGoBundle\Form;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;

class ManageController extends Controller
{
    /**
     * @Route("/admin", name="admin_index")
     */
    public function adminIndexAction(){
        $session = $this->get('session');
        return $this->render('HearWeGoHearWeGoBundle:Manage:index.html.twig');
    }

    /**
     * @Route("/admin/user", name="manage_user")
     */
    public function manageUserAction() {
        return $this->render('HearWeGoHearWeGoBundle:Manage/user:user.html.twig');
    }

    /**
     * @Route("/admin/user/add",name="add_user")
     */
    public function addUserAction() {
        return $this->render('@HearWeGoHearWeGo/Manage/user/adduser.html.twig');
    }

    /**
     * @Route("/admin/user/profile",name="user_profile")
     */
    public function profileAction() {
        return $this->render('@HearWeGoHearWeGo/Manage/user/profile.html.twig');
    }

    /**
     * @Route("/admin/article",name="manage_article")
     */
    public function manageArticleAction() {
        return $this->render('@HearWeGoHearWeGo/Manage/article/article.html.twig');
    }


    /**
     * @Route("/admin/article/add", name="add_article")
     */
    public function addArticleAction() {

        $request = $this->get('request');
        $session = $this->get('session');
        $article = new Article();
        $form = $this->createForm(new Form\ArticleType(), $article, array(
            'method' => 'POST',
            'action' => $this->generateUrl('add_article')
        ));
        $form->add('submit', 'submit');
        $form->handleRequest($request);
        if ( $request->getMethod() == 'POST'){
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();
            $session->getFlashBag()->add('status', 'Success');
            return $this->render('@HearWeGoHearWeGo/Manage/article/addarticle.html.twig', array(
                'form' => $form->createView()
            ));
        }

        return $this->render('@HearWeGoHearWeGo/Manage/article/addarticle.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/article/tag",name="manage_tag")
     */
    public function manageTagAction() {
        return $this->render('@HearWeGoHearWeGo/Manage/article/tag.html.twig');
    }

    /**
     * @Route("/admin/audio", name="manage_audio")
     */
    public function manageAudioAction() {
        return $this->render('@HearWeGoHearWeGo/Manage/audio/audio.html.twig');
    }

    /**
     * @Route("/admin/audio/add", name="add_audio")
     */
    public function addAudioAction() {
        return $this->render('@HearWeGoHearWeGo/Manage/audio/addaudio.html.twig');
    }

    /**
     * @Route("/admin/audio/assign",name="assign_audio")
     */
    public function assignAudioAction(){
        return $this->render('@HearWeGoHearWeGo/Manage/audio/assign.html.twig');
    }

    /**
     * @Route("/admin/destination",name="manage_destination")
     */
    public function manageDestinationAction() {
        return $this->render('@HearWeGoHearWeGo/Manage/destination/destination.html.twig');
    }

    /**
     * @Route("/admin/destination/add",name="add_destination")
     */
    public function addDestinationAction(){
        return $this->render('@HearWeGoHearWeGo/Manage/destination/adddestination.html.twig');
    }

    /**
     * @Route("/admin/company",name="manage_company")
     */
    public function manageCompanyAction(){
        return $this->render('@HearWeGoHearWeGo/Manage/company/company.html.twig');
    }

    /**
     * @Route("/admin/company/add",name="add_company")
     */
    public function addCompanyAction(){
        return $this->render('@HearWeGoHearWeGo/Manage/company/addcompany.html.twig');
    }

    /**
     * @Route("/admin/tour",name="manage_tour")
     */
    public function manageTourAction(){
        return $this->render('@HearWeGoHearWeGo/Manage/tour/tour.html.twig');
    }

    /**
     * @Route("/admin/rating", name="manage_rating")x
     */
    public function manageRatingAction() {
        return $this->render('@HearWeGoHearWeGo/Manage/rating/rating.html.twig');
    }

    /**
     * @Route("/admin/rating/audio", name="audio_rating")
     */
    public function audioRatingAction() {
        return $this->render('@HearWeGoHearWeGo/Manage/rating/audiorating.html.twig');
    }

    /**
     * @Route("/admin/comment", name="manage_comment")
     */
    public function manageCommentAction(){
        return $this->render('@HearWeGoHearWeGo/Manage/comment/commnent.html.twig');
    }



}
