<?php
namespace HearWeGo\HearWeGoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use HearWeGo\HearWeGoBundle\Entity\Company;
use HearWeGo\HearWeGoBundle\Entity\Tour;
use HearWeGo\HearWeGoBundle\Form\CompanySignupType;
use HearWeGo\HearWeGoBundle\Form\CompanySubmitTourType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CompanyController extends Controller
{
    /**
     * @Route("/company/signup",name="company_signup")
     */
    public function signupAction(Request $request)
    {
        $company=new Company();
        $form=$this->createForm(new CompanySignupType(),$company,array('method'=>'POST','action'=>$this->generateUrl('company_signup')));
        $form->add('submit','submit');
        $form->handleRequest($request);
        if ($request->getMethod()=='POST')
        {
            if ($form->isValid())
            {
                $em=$this->getDoctrine()->getEntityManager();
                $em->persist($company);
                $em->flush();
                return new Response("<html>".$company->getName()." has been created!</html>");
            }
        }
        return $this->render('HearWeGoHearWeGoBundle:Company:companySignup.html.twig', array('form'=>$form->createView()));
    }

    /**
     * @Route("/company/submit",name="company_submit")
     */
    public function submitTourAction(Request $request)
    {
        $tour=new Tour();
        $form=$this->createForm(new CompanySubmitTourType(),$tour,array('method'=>'POST','action'=>$this->generateUrl('company_submit')));
        $repository=$this->getDoctrine()->getRepository('HearWeGoHearWeGoBundle:Destination')->findAll();
        $dest_arr=array();
        $form_check=$this->createFormBuilder($dest_arr,array('method'=>'POST','action'=>$this->generateUrl('company_submit')));
        $i=0;
        foreach ($repository as $item)
        {
            $i++;
            $form_check->add('destination','checkbox',array('label'=>$item->getName()));
        }
        $form_check->add('submit','submit');
        $form->handleRequest($request);
        if ($request->getMethod()=='POST')
        {
            if ($form->isValid())
            {
                $em=$this->getDoctrine()->getEntityManager();

                $em->persist($tour);
                $em->flush();
                return new Response("<html>".$tour->getName()." has been created!</html>");
            }
        }
        return $this->render('HearWeGoHearWeGoBundle:Company:companySubmit.html.twig',array('form1'=>$form->createView(),'form2'=>$form_check->getForm()->createView()));
    }
}
?>