<?php

namespace HearWeGo\HearWeGoBundle\Entity\Repository;

use Doctrine\ORM\Tools\Pagination\Paginator;

class DoctrineHelp
{
    static public function paginate($query, &$pageSize = 10, &$currentPage = 1){
        $pageSize = (int)$pageSize;
        $currentPage = (int)$currentPage;

        if( $pageSize < 1 ){
            $pageSize = 10;
        }

        if( $currentPage < 1 ){
            $currentPage = 1;
        }

        $paginator = new Paginator($query);

        $paginator
            ->getQuery()
            ->setFirstResult($pageSize * ($currentPage - 1))
            ->setMaxResults($pageSize)
        ;

        return $paginator;
    }
}

?>