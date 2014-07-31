<?php

namespace JF\UtilityBundle\Controller\Traits;

trait PaginatorController {

    /**
     * 
     * @return \Knp\Component\Pager\Paginator
     */
    protected function getPaginator() {
        try { 
            return $this->get('knp_paginator');
        } catch (\Exception $e) {
            throw new \Exception('Please add "knplabs/knp-paginator-bundle": "dev-master" on your composer.json');
        }
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