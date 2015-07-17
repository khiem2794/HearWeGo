<?php
/**
 * Created by PhpStorm.
 * User: khiem
 * Date: 16/07/2015
 * Time: 15:15
 */

namespace HearWeGo\HearWeGoBundle\Util;

use Doctrine\ORM\EntityManager;


class DestinationUtil {

    private $manager;

    function __construct(EntityManager $manager)
    {
        $this->manager = $manager;
    }

    public function getDestinationRepo(){
        return $this->manager->getRepository('HearWeGoHearWeGoBundle:Destination');
    }

}