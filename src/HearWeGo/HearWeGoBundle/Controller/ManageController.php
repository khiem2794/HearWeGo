<?php

namespace HearWeGo\HearWeGoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ManageController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }
}
