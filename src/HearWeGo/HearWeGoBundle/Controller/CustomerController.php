<?php

namespace HearWeGo\HearWeGoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CustomerController extends Controller
{
    /**
     * @Route("/my_account", name="personal")
     */
    public function personalAction(){

    }

    /**
     * @Route("/my_account/edit", name="edit_info")
     */
    public function editInfoAction(){

    }

    /**
     * @Route("/my_account/change_password", name="change_password")
     */
    public function changePasswordAction(){

    }

    /**
     * @Route("/my_account/downloads", name="downloads")
     */
    public function downloadAction(){

    }

    /**
     * @Route("/my_account/orders", name="orders")
     */
    public function ordersAction(){

    }

}
