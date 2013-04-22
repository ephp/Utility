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
     * Restituisce il repository richiesto
     * 
     * @param type $classe nome del repository
     * @return @return \Doctrine\ORM\EntityRepository 
     */
    protected function getRepository($classe) {
        return $this->getEm()->getRepository($classe);
    }
    
    /**
     * Fa il find da un repository
     * 
     * @param string $classe nome del repository
     * @param array $id id dell'oggetto
     * @return Mixed
     */
    protected function find($classe, $id) {
        return $this->getRepository($classe)->find($id);
    }
    
    /**
     * Fa il findBy da un repository
     * 
     * @param string $classe nome del repository
     * @param array $find array con i criteri di ricerca
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    protected function findBy($classe, $find, $order = array(), $limit = null, $from = null) {
        return $this->getRepository($classe)->findBy($find, $order, $limit, $from);
    }
    
    /**
     * Fa il findOneBy da un repository
     * 
     * @param string $classe nome del repository
     * @param array $find array con i criteri di ricerca
     * @return Mixed
     */
    protected function findOneBy($classe, $find, $order = array()) {
        return $this->getRepository($classe)->findOneBy($find, $order);
    }
    
}