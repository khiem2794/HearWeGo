<?php

namespace HearWeGo\HearWeGoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CompanyController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }
}
