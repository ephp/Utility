<?php

namespace Ephp\UtilityBundle\Controller\Traits;

trait BaseController {

    /**
     * @return \Doctrine\ORM\EntityManager 
     */
    protected function getEm() {
        return $this->getDoctrine()->getEntityManager();
    }
    
    /**
     * @return \Doctrine\ORM\EntityRepository 
     */
    protected function getRepository($classe) {
        return $this->getEm()->getRepository($classe);
    }
    
}