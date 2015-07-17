<?php
namespace HearWeGo\HearWeGoBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
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
     *
     */
    public function submitTourAction(Request $request)
    {

        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirect($this->generateUrl('user_login'));
        }
        $this->denyAccessUnlessGranted('ROLE_COMPANY', null, 'Unable to access this page!');

        $tour=new Tour();
        $form=$this->createForm(new CompanySubmitTourType($this->get('destination.transformer')),$tour,array(
            'method'=>'POST',
            'action'=>$this->generateUrl('company_submit')
        ));
        $form->add('submit', 'submit');

        if ($request->getMethod()=='POST')
        {
            $form->handleRequest($request);
            if ($form->isValid())
            {
                $em=$this->getDoctrine()->getEntityManager();

                $em->persist($tour);
                $em->flush();
                return new Response(' Success ');
            }
            return new Response('not valid');
        }
        return $this->render('HearWeGoHearWeGoBundle:Company:companySubmit.html.twig',array('form1'=>$form->createView()));
    }
}
