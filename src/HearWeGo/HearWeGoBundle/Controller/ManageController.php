<?php

namespace HearWeGo\HearWeGoBundle\Controller;

use HearWeGo\HearWeGoBundle\Entity\Audio;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use HearWeGo\HearWeGoBundle\Entity\User;
use HearWeGo\HearWeGoBundle\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;
use HearWeGo\HearWeGoBundle\Form\AddAudioType;

class ManageController extends Controller
{
    /**
     * @Route("/admin", name="admin_index")
     */
    public function adminIndexAction(){
        $session = $this->get('session');
        return $this->render('HearWeGoHearWeGoBundle:manage:index.html.twig');
    }

    /**
     * @Route("/admin/add/audio",name="add_audio")
     */
    public function addAudioAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')){
            return  new Response('Please login');
        }

        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Unable to access this page!');

        $destination_repo=$this->getDoctrine()->getManager()->getRepository('HearWeGoHearWeGoBundle:Destination');
        $audio=new Audio();
        $form=$this->createForm(new AddAudioType(),$audio,array(
            'method'=>'POST',
            'action'=>$this->generateUrl('add_audio'),
            'dr'=>$destination_repo
        ));
        //var_dump ($destination_repo->findDestinationWithoutAudio());
        $form->add('submit','submit');
        if ($request->getMethod()=='POST')
        {
            $form->handleRequest($request);
            if ($form->isValid())
            {
                $destination=$this->getDoctrine()->getRepository('HearWeGoHearWeGoBundle:Destination')
                    ->findByName($form->get('destination')->getData()->getName());
                $audio->setDestination($destination);
                $name=$_FILES['add_audio']['name']['content'];
                $tmp_name=$_FILES['add_audio']['tmp_name']['content'];
                if (isset($name))
                {
                    if (!empty($name))
                    {
                        $location=$_SERVER['DOCUMENT_ROOT']."/bundles/hearwegohearwego/uploads/";
                        move_uploaded_file($tmp_name,$location.$name);
                        $audio->setContent($location.$name);
                        $em=$this->getDoctrine()->getEntityManager();
                        $em->persist($audio);
                        $em->flush();
                        return new Response('Audio '.$audio->getName().' has been created!');
                    }
                }
            }
        }
        return $this->render('@HearWeGoHearWeGo/manage/addAudio.html.twig',array('form'=>$form->createView()));
    }
}
