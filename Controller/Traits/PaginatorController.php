<?php

namespace Ephp\UtilityBundle\Controller\Traits;

trait PaginatorController {

    /**
     * 
     * @return \Knp\Component\Pager\Paginator
     */
    protected function getPaginator() {
        return $this->get('knp_paginator');
    }

    /**
     * 
     * @return \Knp\Component\Pager\Pagination\PaginationInterface
     */
    protected function createPagination($collection, $max=20, $pag_param = 'page') {
        $paginator = $this->getPaginator();
        return $paginator->paginate($collection, $this->getParam($pag_param, 1), $max);
    }


}