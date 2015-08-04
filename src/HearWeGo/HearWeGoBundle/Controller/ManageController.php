<?php

namespace HearWeGo\HearWeGoBundle\Controller;

use HearWeGo\HearWeGoBundle\Entity\Audio;
use HearWeGo\HearWeGoBundle\Entity\Destination;
use HearWeGo\HearWeGoBundle\Entity\Gallery;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use HearWeGo\HearWeGoBundle\Entity\User;
use HearWeGo\HearWeGoBundle\Entity\Article;
use HearWeGo\HearWeGoBundle\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;
use HearWeGo\HearWeGoBundle\Form\AddAudioType;
use HearWeGo\HearWeGoBundle\Form\EditAudioType;

class ManageController extends Controller
{
    /**
     * @Route("/admin", name="admin_index")
     */
    public function adminIndexAction()
    {
        $session = $this->get('session');
        return $this->render('HearWeGoHearWeGoBundle:Manage:index.html.twig');
    }

    /**
     *
     * @Route("/admin/user", name="manage_user")
     */
    public function manageUserAction()
    {
        $users=$this->getDoctrine()->getRepository('HearWeGoHearWeGoBundle:User')->findAll();
        return $this->render('HearWeGoHearWeGoBundle:Manage/user:user.html.twig',array('users'=>$users));
    }

    /**
     * @Route("/admin/user/add",name="add_user")
     */
    public function addUserAction()
    {
        return $this->render('@HearWeGoHearWeGo/Manage/user/adduser.html.twig');
    }

    /**
     * @Route("/admin/user/{id}",name="info_user")
     */
    public function infoUserAction($id)
    {
        $user=$this->getDoctrine()->getRepository('HearWeGoHearWeGoBundle:User')->findById($id);
        $comments=$user->getComments();
        return $this->render('@HearWeGoHearWeGo/Manage/user/infouser.html.twig',array('user'=>$user,'comments'=>$comments));
    }

    /**
     * @Route("/admin/article",name="manage_article")
     */
    public function manageArticleAction()
    {
        $articles = $this->getDoctrine()->getRepository('HearWeGoHearWeGoBundle:Article')->findAll();
        return $this->render('@HearWeGoHearWeGo/Manage/article/article.html.twig', array('articles' => $articles));
    }

    /**
     * @Route("/admin/article/add", name="add_article")
     */
    public function addArticleAction()
    {

        $request = $this->get('request');
        $session = $this->get('session');
        $article = new Article();
        $form = $this->createForm(new Form\ArticleType(), $article, array(
            'method' => 'POST',
            'action' => $this->generateUrl('add_article')
        ));
        $form->add('submit', 'submit');
        $form->handleRequest($request);
        if ($request->getMethod() == 'POST') {

            $em = $this->getDoctrine()->getManager();
            $article->upload();
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
    public function manageTagAction()
    {
        return $this->render('@HearWeGoHearWeGo/Manage/article/tag.html.twig');
    }

    /**
     * @Route("/admin/article/{id}",name="edit_article")
     */
    public function editArticleAction($id, Request $request)
    {
        $article = $this->getDoctrine()->getRepository('HearWeGoHearWeGoBundle:Article')->findById($id);
        $form = $this->createForm(new Form\ArticleType(), $article, array('method' => 'POST', 'action' => $this->generateUrl('edit_article', array('id' => $id))));
        $form->add('submit', 'submit');
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $article->upload();
                $em->persist($article);
                $em->flush();
                return $this->render('@HearWeGoHearWeGo/Manage/article/editarticle.html.twig', array(
                    'form' => $form->createView(), 'article' => $article));
            }
        }
        return $this->render('@HearWeGoHearWeGo/Manage/article/editarticle.html.twig', array(
            'form' => $form->createView(), 'article' => $article
        ));
    }

    /**
     * @Route("/admin/article/delete/{id}",name="delete_article")
     */
    public function deleteArticleAction($id)
    {
        $article = $this->getDoctrine()->getRepository('HearWeGoHearWeGoBundle:Article')->findById($id);
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($article);
        $em->flush();
        return $this->redirectToRoute('manage_article');
    }



    /**
     * @Route("/admin/audio", name="manage_audio")
     */
    public function manageAudioAction()
    {
        $audios = $this->getDoctrine()->getRepository('HearWeGoHearWeGoBundle:Audio')->findAll();
        return $this->render('@HearWeGoHearWeGo/Manage/audio/audio.html.twig', array('audios' => $audios));
    }

    /**
     * @Route("/admin/audio/add", name="add_audio")
     */
    public function addAudioAction()
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            return new Response('Please login');
        }

        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Unable to access this page!');

        $session = $this->get('session');
        $request = $this->get('request');
        $destination_repo = $this->getDoctrine()->getManager()->getRepository('HearWeGoHearWeGoBundle:Destination');
        $audio = new Audio();
        $form = $this->createForm(new AddAudioType(), $audio, array(
            'method' => 'POST',
            'action' => $this->generateUrl('add_audio'),
            'dr' => $destination_repo
        ));
        //var_dump ($destination_repo->findDestinationWithoutAudio());
        $form->add('submit', 'submit');
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            $destination = $this->getDoctrine()->getRepository('HearWeGoHearWeGoBundle:Destination')
                ->findByName($form->get('destination')->getData()->getName());
            $audio->setDestination($destination);
            $em = $this->getDoctrine()->getEntityManager();
            $audio->upload();
            $em->persist($audio);
            $em->flush();

            $session->getFlashBag()->add('status', 'success');
            return $this->render('@HearWeGoHearWeGo/Manage/audio/addaudio.html.twig', array('form' => $form->createView()));


        }
        return $this->render('@HearWeGoHearWeGo/Manage/audio/addaudio.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/admin/audio/{id}",name="edit_audio")
     */
    public function editAudioAction($id, Request $request)
    {
        $audio = $this->getDoctrine()->getRepository('HearWeGoHearWeGoBundle:Audio')->findById($id);
        $form = $this->createForm(new EditAudioType(), $audio, array(
            'method' => 'POST',
            'action' => $this->generateUrl('edit_audio', array('id' => $id))
        ));
        $form->add('destination','entity',array(
            'class'=>'HearWeGo\HearWeGoBundle\Entity\Destination',
            'choices'=>$this->getDoctrine()->getRepository('HearWeGoHearWeGoBundle:Destination')->findToReplaceAudio($id),
            'property'=>'name'
        ));
        $form->add('submit','submit');
        if ($request->getMethod()=='POST')
        {
            $form->handleRequest($request);
            $em=$this->getDoctrine()->getEntityManager();
            $audio->upload();
            $em->persist($audio);
            $em->flush();
            return $this->render('@HearWeGoHearWeGo/Manage/audio/editaudio.html.twig',array('form'=>$form->createView(),'audio'=>$audio));
        }
        return $this->render('@HearWeGoHearWeGo/Manage/audio/editaudio.html.twig', array('form'=>$form->createView(),'audio'=>$audio));
    }
    /**
     * @Route("/admin/destination",name="manage_destination")
     */
    public function manageDestinationAction()
    {
        $destinations = $this->getDoctrine()->getRepository('HearWeGoHearWeGoBundle:Destination')->findAll();
        return $this->render('@HearWeGoHearWeGo/Manage/destination/destination.html.twig', array('destinations' => $destinations));
    }


    /**
     * @Route("/admin/destination/add",name="add_destination")
     */
    public function addDestinationAction()
    {

        $request = $this->get('request');
        $session = $this->get('session');

        $destination = new Destination();
        $form = $this->createForm(new Form\DestinationType(), $destination, array(
            'method' => 'POST',
            'action' => $this->generateUrl('add_destination')
        ));
        $form->add('submit', 'submit');
        $form->handleRequest($request);
        if ($request->getMethod() == 'POST') {

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($destination);
                $em->flush();

                $session->getFlashBag()->add('status', 'Success');

                return $this->render('@HearWeGoHearWeGo/Manage/destination/adddestination.html.twig', array(
                    'form' => $form->createView()
                ));

            }

        }


        return $this->render('@HearWeGoHearWeGo/Manage/destination/adddestination.html.twig', array(
            'form' => $form->createView()
        ));

    }

    /**
     * @Route("/admin/destination/{id}",name="edit_destination")
     */
    public function editDestinationAction($id, Request $request)
    {
        $destination = $this->getDoctrine()->getRepository('HearWeGoHearWeGoBundle:Destination')->findById($id);
        $form = $this->createForm(new Form\DestinationType(), $destination, array('method' => 'POST', 'action' => $this->generateUrl('edit_destination', array('id' => $id))));
        $form->add('submit', 'submit');
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($destination);
                $em->flush();
                return $this->render('@HearWeGoHearWeGo/Manage/destination/editdestination.html.twig', array('form' => $form->createView()));
            }
        }
        return $this->render('@HearWeGoHearWeGo/Manage/destination/editdestination.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/admin/destination/delete/{id}",name="delete_destination")
     */
    public function deleteDestinationAction($id)
    {
        $destination = $this->getDoctrine()->getRepository('HearWeGoHearWeGoBundle:Destination')->findById($id);
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($destination);
        $em->flush();
        return $this->redirectToRoute('manage_destination');
    }

    /**
     * @Route("/admin/company",name="manage_company")
     */
    public function manageCompanyAction()
    {
        $companies = $this->getDoctrine()->getRepository('HearWeGoHearWeGoBundle:Company')->findAll();
        return $this->render('@HearWeGoHearWeGo/Manage/company/company.html.twig', array('companies' => $companies));
    }

    /**
     * @Route("/admin/company/add",name="add_company")
     */
    public function addCompanyAction()
    {
        return $this->render('@HearWeGoHearWeGo/Manage/company/addcompany.html.twig');
    }

    /**
     * @Route("/admin/tour",name="manage_tour")
     */
    public function manageTourAction()
    {
        $tours = $this->getDoctrine()->getRepository('HearWeGoHearWeGoBundle:Tour')->findAll();
        return $this->render('@HearWeGoHearWeGo/Manage/tour/tour.html.twig', array('tours' => $tours));
    }

    /**
     * @Route("/admin/tour/approve",name="approve_tour")
     */
    public function approveTourAction()
    {

        return $this->render('@HearWeGoHearWeGo/Manage/tour/approvetour.html.twig');
    }

    /**
     * @Route("/admin/rating", name="manage_rating")
     */
    public function manageRatingAction()
    {
        return $this->render('@HearWeGoHearWeGo/Manage/rating/rating.html.twig');
    }

    /**
     * @Route("/admin/rating/audio", name="audio_rating")
     */
    public function audioRatingAction()
    {
        return $this->render('@HearWeGoHearWeGo/Manage/rating/audiorating.html.twig');
    }


    /**
     * @Route("/admin/media", name="manage_media")
     */
    public function manageMediaAction()
    {
        $images = $this->getDoctrine()->getRepository('HearWeGoHearWeGoBundle:Gallery')->findAll();
        return $this->render('@HearWeGoHearWeGo/Manage/media/media.html.twig', array('images' => $images));
    }

    /**
     * @Route("/admin/media/add", name="add_media")
     */
    public function uploadMediaAction()
    {
        $request = $this->get('request');
        $session = $this->get('session');

        $img = new Gallery();
        $form = $this->createForm(new Form\GalleryType(), $img, array(
            'method' => 'POST',
            'action' => $this->generateUrl('add_media')
        ));
        $form->add('submit', 'submit');

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $img->upload();
                $em->persist($img);
                $em->flush();

                $session->getFlashBag()->add('status', 'success');
                return $this->render('@HearWeGoHearWeGo/Manage/media/uploadmedia.html.twig', array(
                    'form' => $form->createView()
                ));
            }
        }

        return $this->render('@HearWeGoHearWeGo/Manage/media/uploadmedia.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/media/{id}",name="edit_media")
     */
    public function editMediaAction($id, Request $request)
    {
        $image = $this->getDoctrine()->getRepository('HearWeGoHearWeGoBundle:Gallery')->findById($id);
        $form = $this->createForm(new Form\GalleryType(), $image, array('method' => 'POST', 'action' => $this->generateUrl('edit_media', array('id' => $id))));
        $form->add('submit', 'submit');
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $image->upload();
                $em->persist($image);
                $em->flush();
                return $this->render('@HearWeGoHearWeGo/Manage/media/editmedia.html.twig', array('form' => $form->createView(), 'image' => $image));
            }
        }
        return $this->render('@HearWeGoHearWeGo/Manage/media/editmedia.html.twig', array('form' => $form->createView(), 'image' => $image));
    }

    /**
     * @Route("/admin/media/delete/{id}",name="delete_media")
     */
    public function deleteMediaAction($id)
    {
        $image = $this->getDoctrine()->getRepository('HearWeGoHearWeGoBundle:Gallery')->findById($id);
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($image);
        $em->flush();
        return $this->redirectToRoute('manage_media');
    }

    /**
     * @Route("/admin/comment", name="manage_comment")
     */
    public function manageCommentAction()
    {
        $comments=$this->getDoctrine()->getRepository('HearWeGoHearWeGoBundle:Comment')->findAllDesc();
        return $this->render('@HearWeGoHearWeGo/Manage/comment/comment.html.twig',array('comments'=>$comments));
    }


}