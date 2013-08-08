<?php

namespace Ephp\UtilityBundle\Controller\Traits;

trait BaseController {

    /**
     * @return \Doctrine\ORM\EntityManager 
     */
    protected function getEm() {
        return $this->getDoctrine()->getManager();
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
    
    /**
     * Restituisce il repository richiesto
     * 
     * @param type $classe entity da persistere
     */
    protected function persist($entity) {
        $this->getEm()->persist($entity);
        $this->getEm()->flush();
    }
    
    /**
     * Restituisce il repository richiesto
     * 
     * @param type $classe entity da persistere
     */
    protected function remove($entity) {
        $this->getEm()->remove($entity);
        $this->getEm()->flush();
    }
    
    protected function getParam($name, $default = null) {
        $out = $this->getRequest()->get($name, null);
        if($out === null) {
            if($default instanceof \Exception) {
                throw $default;
            }
            $out = $default;
        }
        return $out;
    }
    
    protected function hasRole($role) {
        $user = $this->getUser();
        return $user->hasRole($role);
    }
    
    protected function inRole($roles) {
        $user = $this->getUser();
        $out = false;
        foreach($roles as $role) {
            $out != $user->hasRole($role);
        }
        return $out;
    }
    
}