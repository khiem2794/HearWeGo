<?php

namespace HearWeGo\HearWeGoBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use HearWeGo\HearWeGoBundle\Entity\User;
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
        return $this->render('HearWeGoHearWeGoBundle:manage:index.html.twig');
    }

}
